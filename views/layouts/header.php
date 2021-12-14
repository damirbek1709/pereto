<?php

use app\models\Business;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Consumer;
?>
<header>
    <?php
    $class_fixed = "fixed-top";
    if (!Yii::$app->user->isGuest) {
        echo $this->render('admin');
        $class_fixed = "";
    }
    $consumers = Consumer::find()->all();
    $consumer_items = [];
    foreach ($consumers as $item) {
        $consumer_items[] = ['label' => $item['title'], 'url' => ["/consumers-information?type=$item->id"]];
    }

    $business = Business::find()->all();
    $business_items = [];
    foreach ($business as $item) {
        $business_items[] = ['label' => $item['title'], 'url' => ["/businesses-information?type=$item->id"]];
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
                'label' => 'Главная',
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
                'label' => 'Потребителям',
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
                        'url' => ['/photo'],
                    ],
                ],
                'url' => ['/site/contact']
            ],
            ['label' => Yii::t('app', 'Новости'), 'url' => ['/news']],
            [
                'label' => $language, 'url' => ['/site/contact'],
                'items' => [
                    [
                        'label' => Yii::t('app', 'En'),
                        'url' => ['/reports'],
                    ],
                    [
                        'label' =>  Yii::t('app', 'Кыр'),
                        'url' => ['/video'],
                    ],
                ],
            ],
            ['label' => 'Войти', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>
</header>