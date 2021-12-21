<?php

namespace app\controllers;

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
        $searchModel = new LibrariesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
                foreach ($category_arr as $key => $val) {
                    $bridge = new Bridge();
                    $bridge->post_id = $model->id;
                    $bridge->category_id = $val;
                    $bridge->save(false);
                }
                foreach ($type_arr as $key => $val) {
                    $bridge = new Bridge();
                    $bridge->post_id = $model->id;
                    $bridge->type_id = $val;
                    $bridge->save(false);
                }
                foreach ($tag_arr as $key => $val) {
                    $bridge = new Bridge();
                    $bridge->post_id = $model->id;
                    $bridge->tag_id = $val;
                    $bridge->save(false);
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
            foreach ($category_arr as $key => $val) {
                $bridge = new Bridge();
                $bridge->post_id = $model->id;
                $bridge->category_id = $val;
                $bridge->save(false);
            }
            foreach ($type_arr as $key => $val) {
                $bridge = new Bridge();
                $bridge->post_id = $model->id;
                $bridge->type_id = $val;
                $bridge->save(false);
            }
            foreach ($tag_arr as $key => $val) {
                $bridge = new Bridge();
                $bridge->post_id = $model->id;
                $bridge->tag_id = $val;
                $bridge->save(false);
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
