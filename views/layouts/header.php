<?php

use app\models\Business;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Consumer;
use app\models\App;
?>
<header>
    <?php
    $amp = '?';
    if (isset($_GET['type'])) {
        $amp = "?type=" . $_GET['type'] . "&";
    }
    $language_label = App::getLanguageLabel();
    $language_arr = [
        'en' => [
            'label' => Yii::t('app', 'Eng'),
            'url' => $amp . "language=en",
        ],
        'ky' => [
            'label' => Yii::t('app', 'Кыр'),
            'url' => $amp . "language=ky",
        ],
        'ru' => [
            'label' => Yii::t('app', 'Рус'),
            'url' => $amp . "language=ru",
        ],
    ];
    unset($language_arr[Yii::$app->language]);

    if (Yii::$app->user->isGuest) {
        $log_label = ['label' => Yii::t('app', 'Войти'), 'url' => ['/user/login']];
    } else {
        $log_label = [
            'label' => Yii::t('app', 'Выйти'),
            'url' => ['/user/logout'],
            'linkOptions' => ['data-method' => 'POST']
        ];
    }

    $class_fixed = "fixed-top";
    if (!Yii::$app->user->isGuest) {
        echo $this->render('admin');
        $class_fixed = "";
    }
    $consumers = Consumer::find()->all();
    $consumer_items = [];
    foreach ($consumers as $item) {
        $item->translate(Yii::$app->language);
        $consumer_items[] = ['label' => $item['title'], 'url' => ["/consumers-information?type=$item->id"]];
    }

    $business = Business::find()->all();
    $business_items = [
        ['label' => Yii::t('app', 'Библиотека'), 'url' => ["/libraries"]]
    ];
    foreach ($business as $item) {
        $item->translate(Yii::$app->language);
        if ($item->id == 5) {
            $business_items[] = ['label' => $item['title'], 'url' => ["/businesses-information/selfassessment_tools"]];
        } else {
            $business_items[] = ['label' => $item['title'], 'url' => ["/businesses-information?type=$item->id"]];
        }
    }

    $language = "Рус";
    NavBar::begin([
        'brandLabel' => Html::img(Url::base() . "/images/logo.png"),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => "navbar navbar-expand-md {$class_fixed} navbar-custom",
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-light'],
        'items' => [
            [
                'label' => Yii::t('app', 'Главная'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Описание проекта'),
                        'url' => ['/about'],
                    ],
                    [
                        'label' =>  Yii::t('app', 'Партнеры проекта'),
                        'url' => ['/partners'],
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Потребителям'),
                'items' => $consumer_items
            ],
            [
                'label' => Yii::t('app', 'Бизнес'),
                'items' => $business_items
            ],
            [
                'label' => Yii::t('app', 'Медиа'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Публикации'),
                        'url' => ['/reports'],
                    ],
                    [
                        'label' =>  Yii::t('app', 'Видео'),
                        'url' => ['/video'],
                    ],
                    [
                        'label' =>  Yii::t('app', 'Фотографии'),
                        'url' => ['/gallery'],
                    ],
                ],
                'url' => ['/site/contact']
            ],
            ['label' => Yii::t('app', 'Новости'), 'url' => ['/news']],
            [
                'label' => $language_label,
                'url' => '#',
                'items' => $language_arr
            ],
            $log_label
        ],
    ]);
    NavBar::end();
    ?>
</header>