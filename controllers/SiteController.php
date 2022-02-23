<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NewsSearch;
use app\models\Page;
use app\models\Seo;
use app\models\App;

class SiteController extends Controller
{
    public $layout;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => Yii::$app->urlManager->createUrl('images/site/redactor'), // Directory URL address, where files are stored.
                'path' => '@webroot/images/site/redactor', // Or absolute path to directory where files are stored.
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => Yii::$app->urlManager->createUrl('images/site/redactor'), // Directory URL address, where files are stored.
                'path' => '@webroot/images/site/redactor', // Or absolute path to directory where files are stored.
                'uploadOnlyImage' => false, // For any kind of files uploading.
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        App::registerSeoTags();
        $canonical_url = "https://pereto.kg";
        if (Yii::$app->request->get()) {
            $canonical_url = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        }
        \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => $canonical_url]);
        $this->layout = "main_index";
        return $this->render('index');
    }

    private function registerSeoTags()
    {
        $url_string = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $seo = Seo::find()->where(['url' => $url_string])->one();
        if ($seo) {
            $seo->translate(Yii::$app->language);
            \Yii::$app->view->registerMetaTag([
                'name' => 'title',
                'content' => $seo->meta_title
            ]);

            \Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $seo->meta_description
            ]);

            \Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $seo->meta_keywords
            ]);
        }
        //return ['seo_text' => $seo_text];
    }

    public function actionPartners()
    {
        App::registerSeoTags();
        return $this->render('partners');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $item = Page::findOne(1);
        $item->translate(Yii::$app->language);
        $page_title = App::registerSeoStatic();
        return $this->render('about', ['item' => $item,'title'=>$page_title]);
    }

    public function actionAdmin()
    {
        $this->layout = "admin";
        return $this->render('admin');
    }

    public function actionConsumersInformation($type)
    {
        $page_id = 1;
        switch ($type) {
            case 1:
                $page_id = 2;
                break;
            case 2:
                $page_id = 3;
                break;
            default:
                $page_id = 2;
        }
        $page = Page::findOne($page_id);
        return $this->render('consumer', ['item' => $page]);
    }

    public function actionBusinessInformation($type)
    {
        $page_id = 1;
        switch ($type) {
            case 1:
                $page_id = 2;
                break;
            case 2:
                $page_id = 3;
                break;
            default:
                $page_id = 2;
        }
        $page = Page::findOne($page_id);
        return $this->render('consumer', ['item' => $page]);
    }
}
