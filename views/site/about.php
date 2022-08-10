<?php

/* @var $this yii\web\View */

use app\models\Page;
use yii\helpers\Html;
$this->params['breadcrumbs'][] = $item->title;
?>
<div class="site-about">    
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