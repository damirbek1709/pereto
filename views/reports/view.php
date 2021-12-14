<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reports */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reports-view">
    <h1 class="main-heading"><?= Html::encode($this->title) ?></h1>
    <div class="report-view-img">
        <?=Html::img($model->getWallpaper());?>
    </div>
    <div class="row top-margin-20">
        <div class="col-lg-12"><?= $model->text; ?></div>
    </div>
</div>