<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<?php
echo Html::beginTag('a', ['href' => Url::to("/news/{$model->id}"), 'class' => '']);
$model->translate(Yii::$app->language);
?>
    <?php
    echo Html::beginTag('div', ['class' => "news-img-cover", 'style' => "background-image:url(" . $model->getWallpaper() . ");height:250px"]);
    echo Html::tag('div', $model->title, ['class' => 'news-slider-title']);
    echo Html::endTag('div');
    ?>
<?= Html::endTag('a'); ?>