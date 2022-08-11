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

<div class="libraries-view">
    <div class="row">
        <div class="col-lg-12">
            <?= Html::img($model->getWallpaper(), ['class' => 'news-view-img']); ?>
            <div class="news-view-title">
                <?= $model->title; ?>
            </div>
            <div class="news-view-text">
                <?= $model->text; ?>
            </div>            
        </div>
    </div>
</div>