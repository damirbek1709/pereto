<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<?php
echo Html::beginTag('a', ['href' => Url::to("/news/{$model->id}"), 'class' => '']);
$model->translate(Yii::$app->language);
?>
<div class="row">
    <div class="col-lg-5">
        <div class="news-block-img">
            <?= Html::img($model->getWallpaper()); ?>
        </div>
    </div>

    <div class="col-lg-7">
        <?= Html::tag('div', $model->title, ['class' => 'news-index-title']); ?>
        <?= Html::tag('div', StringHelper::truncateWords($model->description, 25, $suffix = '...'), []); ?>
    </div>
</div>
<?= Html::endTag('a'); ?>