<?php

namespace app\controllers;

use Yii;
use app\models\App;
use app\models\Bridge;
use app\models\Libraries;
use app\models\LibrariesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LibrariesController implements the CRUD actions for Libraries model.
 */
class LibrariesController extends Controller
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
     * Lists all Libraries models.
     * @return mixed
     */
    public function actionIndex()
    {
        App::registerSeoTags();
        $searchModel = new LibrariesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $type = [];
        $category = [];
        $tag = [];


        $dataProvider->query->joinWith(['bridge']);
        if (Yii::$app->request->get('type')) {
            $type = Yii::$app->request->get('type');
        }
        if (Yii::$app->request->get('category')) {
            $category = Yii::$app->request->get('category');
        }
        if (Yii::$app->request->get('tag')) {
            $tag = Yii::$app->request->get('tag');
        }
        $dataProvider->query->andFilterWhere(['bridge.type_id' => $type]);
        $dataProvider->query->andFilterWhere(['bridge.tag_id' => $tag]);
        $dataProvider->query->andFilterWhere(['bridge.category_id' => $category]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => $type,
            'tag' => $tag,
            'category' => $category
        ]);
    }

    public function actionAdmin()
    {
        $searchModel = new LibrariesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libraries model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $tags = $model->tagList;
        $cats = $model->catList;
        $types = $model->typeList;
        $model->translate(Yii::$app->language);
        $title = App::getLibraryTitle();
        $keywordString = "";

        foreach ($tags as $key => $val) {
            $keywordString .= $val[$title].",";
        }

        foreach ($cats as $key => $val) {
            $keywordString .= $val[$title].",";
        }

        foreach ($types as $key => $val) {
            $keywordString .= $val[$title].",";
        }


        \Yii::$app->view->registerMetaTag([
            'name' => 'title',
            'content' => $model->title
        ]);

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $model->description
        ]);

        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $keywordString
        ]);

        return $this->render('view', [
            'model' => $model,
            'tags' => $tags,
            'cats' => $cats,
            'types' => $types,

        ]);
    }

    /**
     * Creates a new Libraries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Libraries();
        $model->scenario = 'insert';

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $category_arr = $this->request->post()['Libraries']['category_id'];
                $type_arr = $this->request->post()['Libraries']['type_id'];
                $tag_arr = $this->request->post()['Libraries']['tag_id'];

                Bridge::deleteAll(['post_id' => $model->id]);
                if (!empty($category_arr)) {
                    foreach ($category_arr as $key => $val) {
                        $bridge = new Bridge();
                        $bridge->post_id = $model->id;
                        $bridge->category_id = $val;
                        $bridge->save(false);
                    }
                }
                if (!empty($type_arr)) {
                    foreach ($type_arr as $key => $val) {
                        $bridge = new Bridge();
                        $bridge->post_id = $model->id;
                        $bridge->type_id = $val;
                        $bridge->save(false);
                    }
                }

                if (!empty($tag_arr)) {
                    foreach ($tag_arr as $key => $val) {
                        $bridge = new Bridge();
                        $bridge->post_id = $model->id;
                        $bridge->tag_id = $val;
                        $bridge->save(false);
                    }
                }
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
     * Updates an existing Libraries model.
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
            $category_arr = $this->request->post()['Libraries']['category_id'];
            $type_arr = $this->request->post()['Libraries']['type_id'];
            $tag_arr = $this->request->post()['Libraries']['tag_id'];

            Bridge::deleteAll(['post_id' => $model->id]);
            if (!empty($category_arr)) {
                foreach ($category_arr as $key => $val) {
                    $bridge = new Bridge();
                    $bridge->post_id = $model->id;
                    $bridge->category_id = $val;
                    $bridge->save(false);
                }
            }
            if (!empty($type_arr)) {
                foreach ($type_arr as $key => $val) {
                    $bridge = new Bridge();
                    $bridge->post_id = $model->id;
                    $bridge->type_id = $val;
                    $bridge->save(false);
                }
            }

            if (!empty($tag_arr)) {
                foreach ($tag_arr as $key => $val) {
                    $bridge = new Bridge();
                    $bridge->post_id = $model->id;
                    $bridge->tag_id = $val;
                    $bridge->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libraries model.
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
     * Finds the Libraries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Libraries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libraries::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
