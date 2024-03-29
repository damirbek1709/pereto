<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserTestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-test-index">

    <h1 class="main-heading"><?= $this->title; ?></h1>

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'organization_name',
        'email',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}'
        ],
    ]; ?>

    <?php
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns
    ]); ?>

    <?php
    // echo  GridView::widget([
    //     'summary' => false,
    //     'dataProvider' => $dataProvider,
    //     'columns' => [
    //         [
    //             'attribute' => 'organization_name',
    //             'value' => function ($model) {
    //                 return Html::a($model->businessType->title, ['view', 'id' => $model->id]);
    //             },
    //             'format' => 'raw'
    //         ],
    //         'email:email',
    //         [
    //             'attribute' => 'date',
    //             'value' => function ($model) {
    //                 return date('d-m-Y', strtotime($model->date));
    //             }
    //         ],
    //         [
    //             'attribute' => 'buisness_type',
    //             'value' => function ($model) {
    //                 return $model->businessType->title;
    //             }
    //         ],
    //         [
    //             'class' => 'yii\grid\ActionColumn',
    //             'template' => '{view}{delete}'
    //         ],
    //     ],
    // ]); 
    ?>


</div>