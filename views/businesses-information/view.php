<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Business */

$this->title = $model->title;
$this->params['breadcrumbs'][] = Yii::t('app', 'Businesses');
$this->params['breadcrumbs'][] = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="business-view">
    <h1 class="main-heading">
        <?= Html::encode($model->title) ?>
    </h1>
    <div class="row top-margin-20">
        <div class="col-lg-12"><?= $model->text; ?></div>
    </div>
</div>
<style>
    .business-view table td {
        border: 1px solid #ccc;
    }
</style>