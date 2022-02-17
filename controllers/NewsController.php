<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\App;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseStringHelper;
use yii\helpers\StringHelper;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        App::registerSeoTags();
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->translate(Yii::$app->language);

        $description = StringHelper::truncateWords($model->text, 40, $suffix = '');        
        $keywords = "lipsum,dolor,sit,amet";

        \Yii::$app->view->registerMetaTag([
            'name' => 'title',
            'content' => $model->title
        ]);

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $description
        ]);

        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $keywords
        ]);

        \Yii::$app->view->registerMetaTag([
            'property' => 'og:url',
            'content' => "https://pereto.kg/news/{$model->id}"
        ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => "website"]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $model->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => BaseStringHelper::truncateWords(strip_tags($model->description), 15)]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => $model->getWallpaper()]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $model->scenario = 'insert';
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['admin', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['admin', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['admin']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
