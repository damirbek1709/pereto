<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-view">

    <h1 class="main-heading"><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?= Html::img($model->getWallpaper(), ['class' => 'page-view-img']); ?>
        </div>
        <div class="col-lg-7">
            <?= $model->description; ?>
        </div>
    </div>

    <div class="row top-margin-20">
        <div class="col-lg-12"><?= $model->text; ?></div>
    </div>

</div>