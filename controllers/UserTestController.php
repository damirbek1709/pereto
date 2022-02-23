<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Libraries;
use app\models\LibraryCategory;
use app\models\Question;
use app\models\UserAnswer;
use app\models\App;
use Yii;
use app\models\UserTest;
use app\models\UserTestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use yii\helpers\FileHelper;

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

    public function actionChangeProgress()
    {
        $categories = LibraryCategory::find()->orderBy(['id' => SORT_ASC])->all();
        $test_id = Yii::$app->request->post('test_id');
        $progress_arr = [];
        $question_arr = [];

        foreach ($categories as $cat) {
            $question = Question::find()->where(['category_id' => $cat->id]);
            $question_amount = $question->count();
            $answer_amount = 0;

            foreach ($question->all() as $item) {
                $question_arr[] = $item->id;
                if (UserAnswer::find()->where(['question_id' => $item->id])
                    ->andWhere(['test_id' => $test_id])
                    ->one()
                ) {
                    $answer_amount = $answer_amount + 1;
                }
            }
            $percent = $answer_amount * 100 / $question_amount;
            $progress_arr[$cat->title_en] = round($percent);
        }
        return json_encode($progress_arr, JSON_UNESCAPED_UNICODE);
    }

    public function actionBeginTest()
    {
        $prefix_title = App::getLibraryTitle();

        $name = Yii::$app->request->post('name');
        $email = Yii::$app->request->post('email');
        $type = Yii::$app->request->post('type');

        Yii::$app->session->set('name', $name);
        Yii::$app->session->set('email', $email);
        Yii::$app->session->set('type', $type);

        $question = Question::find()
            ->orderBy(['category_id' => SORT_ASC, 'question.id' => SORT_ASC])
            ->one();

        $answers = ArrayHelper::map(Answer::find()->where(['question_id' => $question->id])->all(), 'id', $prefix_title);
        $test = UserTest::find()->where(['email' => $email, 'organization_name' => $name, 'buisness_type' => $type])->one();
        if ($test) {
            $answered_already = ArrayHelper::map(
                UserAnswer::find()
                    ->where(['test_id' => $test->id])
                    ->all(),
                'id',
                'question_id'
            );
            $question = Question::find()->where(['not in', 'id', $answered_already])
                ->orderBy(['category_id' => SORT_ASC, 'id' => SORT_ASC])
                ->one();

            if ($question) {
                $answers = ArrayHelper::map(Answer::find()->where(['question_id' => $question->id])->all(), 'id', $prefix_title);
                $categories = ArrayHelper::map(LibraryCategory::find()->where(['<=', 'id', $question->category_id])->all(), 'id', 'id');
                $question_arr = [
                    'id' => $question->id,
                    'title' => $question->$prefix_title,
                    'answers' => $answers,
                    'test_id' => $test->id,
                    'category_id' => $categories,
                ];
                return json_encode([
                    'status' => 1,
                    'type' => $type,
                    'test_id' => $test->id,
                    'arr' => $question_arr
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $result_arr = [];
                $test_id = $test->id;
                $user_answer = UserAnswer::find()->joinWith('question')->where(['test_id' => $test_id, 'category_id' => 1])->orderBy(['id' => SORT_ASC])->all();
                foreach ($user_answer as $item) {
                    $result_arr[$item->id] = [
                        'question' => $item->question->$prefix_title,
                        'answer' => $item->answer->title,
                        'assessment' => $item->answer->assessment,
                        'hint' => $item->answer->hint,
                    ];
                }
                return json_encode([
                    'type' => $type,
                    'status' => 2,
                    'test_id' => $test->id,
                    'arr' => $result_arr
                ], JSON_UNESCAPED_UNICODE);
            }
        } else {
            $test = new UserTest();
            $test->email = $email;
            $test->organization_name = $name;
            $test->buisness_type = $type;
            $categories = ArrayHelper::map(LibraryCategory::find()->where(['<=', 'id', $question->category_id])->all(), 'id', 'id');

            if ($test->save()) {
                $question_arr = [
                    'id' => $question->id,
                    'title' => $question->$prefix_title,
                    'answers' => $answers,
                    'test_id' => $test->id,
                    'category_id' => $categories
                ];
                return json_encode([
                    'status' => 1,
                    'test_id' => $test->id,
                    'arr' => $question_arr,
                    'type' => $type
                ], JSON_UNESCAPED_UNICODE);
            }
        }
        return 'finished';
    }

    public function actionReport()
    {
        $prefix_title = App::getLibraryTitle();
        $prefix_assessment = App::getLibraryAssesment();
        $prefix_hint = App::getLibraryHint();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $name =  Yii::$app->session['name'];
        $email = Yii::$app->session['email'];
        $type = Yii::$app->session['type'];
        $dir = Yii::getAlias("@webroot/pdf/{$email}");
        FileHelper::createDirectory($dir);
        $test = UserTest::find()->where(['email' => $email, 'organization_name' => $name, 'buisness_type' => $type])->one();
        $arr = [];

        if ($test) {
            $ans_query = UserAnswer::find()
                ->where(['test_id' => $test->id])
                ->orderBy(['id' => SORT_ASC])
                ->all();
                
            $data_arr = [];
            foreach ($ans_query as $ans) {
                $question = Question::findOne($ans->question_id);
                $answer = Answer::findOne($ans->answer_id);
                $data_arr['question'] = $question->$prefix_title;
                $data_arr['answer'] = $answer->$prefix_title;
                $data_arr['assessment'] = $answer->$prefix_assessment;
                $data_arr['hint'] = $answer->$prefix_hint;
                $arr[] = $data_arr;
            }
            FileHelper::createDirectory($email);
            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8,
                'destination' => Pdf::DEST_FILE,
                'cssFile' => 'css/pdf.css',
                'filename' => "{$dir}/certificate.pdf",
                'orientation' => Pdf::ORIENT_LANDSCAPE,
                // 'marginLeft' => 0,
                // 'marginTop' => 0,
                // 'marginRight' => 0,
                // 'marginBottom' => 0,
                'content' => $this->renderPartial('report', ['data' => $arr]),
                'options' => [],
                'methods' => []
            ]);
            $pdf->render();

            return $this->redirect(["pdf/{$email}/certificate.pdf"]);
        }
    }

    public function actionNextQuestion()
    {
        $prefix_title = App::getLibraryTitle();
        $id = Yii::$app->request->post('id');
        $answer_id = Yii::$app->request->post('answer');
        $test_id = Yii::$app->request->post('test_id');

        $user_answer = new UserAnswer();
        $user_answer->answer_id = $answer_id;
        $user_answer->test_id = $test_id;
        $user_answer->question_id = $id;
        $user_answer->save(false);

        $past_arr = ArrayHelper::map(
            UserAnswer::find()
                ->where(['test_id' => $test_id])
                ->all(),
            'id',
            'question_id'
        );
        $question = Question::find()->where(['not in', 'id', $past_arr])->orderBy(['category_id' => SORT_ASC, 'id' => SORT_ASC])->one();

        if ($question) {
            $answers = ArrayHelper::map(Answer::find()->where(['question_id' => $question->id])->all(), 'id', $prefix_title);
            $question_arr = [
                'id' => $question->id,
                'title' => $question->$prefix_title,
                'answers' => $answers,
                'category_id' => $question->category_id
            ];
            return json_encode($question_arr, JSON_UNESCAPED_UNICODE);
        }
        return 'finished';
    }

    public function actionShowResults()
    {
        $result_arr = [];
        $test_id = Yii::$app->request->post('test_id');
        $category_id = Yii::$app->request->post('category_id');
        $type = Yii::$app->request->post('type');

        $prefix_title = App::getLibraryTitle();
        $prefix_assessment = App::getLibraryAssesment();
        $prefix_hint = App::getLibraryHint();

        $user_answer = UserAnswer::find()
            ->joinWith('question')
            ->where(['test_id' => $test_id, 'category_id' => $category_id])
            ->orderBy(['id' => SORT_ASC])
            ->all();


        foreach ($user_answer as $item) {
            $articles = ArrayHelper::map(Libraries::find()
                ->joinWith('most')
                ->where(['question_id' => $item->question->id])
                ->andWhere(['business_type' => $type])
                ->all(), 'id', "{$prefix_title}");
            $result_arr[$item->id] = [
                'question' => $item->question->$prefix_title,
                'answer' => $item->answer->$prefix_title,
                'articles' => $articles,
                'assessment' => $item->answer->$prefix_assessment,
                'hint' => $item->answer->$prefix_hint,
            ];
        }
        return json_encode($result_arr, JSON_UNESCAPED_UNICODE);
    }
}
