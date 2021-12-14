<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<div class="site-index-news-block">
    <?= Html::beginTag('a', ['href' => Url::to("/news/{$model->id}"), 'class' => '']); ?>
    <div class="news-block-img">
        <?= Html::img($model->getWallpaper()); ?>
    </div>

    <div class="site-news-content">
    <?= Html::tag('div', $model->title, ['class' => 'news-index-title']); ?>
    <?= Html::tag('div', StringHelper::truncateWords($model->description, 25, $suffix = '...'), []); ?>
    </div>
    <?php Html::endTag('a'); ?>
</div>