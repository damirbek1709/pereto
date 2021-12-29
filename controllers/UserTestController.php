<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\UserAnswer;
use Yii;
use app\models\UserTest;
use app\models\UserTestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UserTestController implements the CRUD actions for UserTest model.
 */
class UserTestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UserTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserTestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserTest model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserTest();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserTest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionBeginTest()
    {
        $name = Yii::$app->request->post('name');
        $email = Yii::$app->request->post('email');
        $type = Yii::$app->request->post('type');

        $question = Question::find()->joinWith('bridge')->orderBy(['business_type_id'=>SORT_ASC,'question.id'=>SORT_ASC])->one();
        $answers = ArrayHelper::map(Answer::find()->where(['question_id' => $question->id])->all(), 'id', 'title');

        $test = new UserTest();
        $test->email = $email;
        $test->organization_name = $name;
        $test->buisness_type = $type;

        if ($test->save()) {
            $question_arr = [
                'id' => $question->id,
                'title' => $question->title,
                'answers' => $answers,
                'test_id' => $test->id,
            ];
            return json_encode($question_arr, JSON_UNESCAPED_UNICODE);
        }
        return false;
    }

    public function actionNextQuestion()
    {
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type');
        $answer_id = Yii::$app->request->post('answer');
        $test_id = Yii::$app->request->post('test_id');

        $user_answer = new UserAnswer();
        $user_answer->answer_id = $answer_id;
        $user_answer->test_id = $test_id;
        $user_answer->question_id = $id;
        $user_answer->save(false);

        $question = Question::find()->where(['>', 'id', $id])->one();
        if ($question) {
            $answers = ArrayHelper::map(Answer::find()->where(['question_id' => $question->id])->all(), 'id', 'title');
            $question_arr = [
                'id' => $question->id,
                'title' => $question->title,
                'answers' => $answers
            ];
            return json_encode($question_arr, JSON_UNESCAPED_UNICODE);
        }
        return 'finished';
    }

    public function actionShowResults()
    {
        $result_arr = [];
        $test_id = Yii::$app->request->post('test_id');
        $user_answer = UserAnswer::find()->where(['test_id' => $test_id])->orderBy(['id' => SORT_ASC])->all();        
        foreach ($user_answer as $item) {
            $result_arr[$item->id] = [
                'question' => $item->question->title,
                'answer' => $item->answer->title,
                'assessment' => $item->answer->assessment,
                'hint' => $item->answer->hint,
            ];
        }
        return json_encode($result_arr, JSON_UNESCAPED_UNICODE);
    }
}
