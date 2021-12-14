<?php

/* @var $this yii\web\View */

use app\models\Page;
use yii\helpers\Html;

$this->title = Yii::t('app','About project');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <?php $item = Page::findOne(1)?>
    <h1 class="main-heading"><?= Html::encode($item->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?= Html::img($item->getWallpaper(), ['class' => 'page-view-img']); ?>
        </div>
        <div class="col-lg-7">
            <?= $item->description; ?>
        </div>
    </div>

    <div class="row top-margin-20">
        <div class="col-lg-12"><?= $item->text; ?></div>
    </div>
</div>
