<?php

use app\models\Video;
use yii\helpers\Url;
use yii\helpers\Html;

$videos = Video::find()->orderBy(['id' => SORT_DESC])->limit(2)->all();
?>

<div class="video-section">
    <div class="container">
        <h1 class="new-heading"><?= Yii::t('app', 'Видео') ?></h1>
        <div class="video-list-cover">
            <?php
            foreach ($videos as $model) {
                echo $model->translate(Yii::$app->language);
                echo Html::beginTag('a', ['href' => Url::to("/video/{$model->id}"), 'class' => 'video-b']);
                $video_img =  $model->getThumbUrl();
                echo Html::beginTag('div', ['class' => 'index-video-img', 'style' => "background-image:url({$video_img})"]);
                echo Html::img(Url::base() . '/images/site/video_play.svg');
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'video-index-title-grid']);
                echo Html::img(Url::base() . '/images/site/pereto_circle.svg');
                echo Html::beginTag('div', ['class' => '']);
                echo Html::tag('div', $model->title, ['class' => 'video-index-title']);
                echo Html::tag('div', 'Pereto KG | ПЭРЭТО КР', ['class' => 'video-index-desc']);
                echo Html::endTag('div');
                echo Html::endTag('div');
                echo Html::endTag('a');
            }
            ?>
        </div>
    </div>
</div>