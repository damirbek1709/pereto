<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'title_en') ?>

    <?= $form->field($model, 'text_en') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'photo_crop') ?>

    <?php // echo $form->field($model, 'photo_cropped') ?>

    <?php // echo $form->field($model, 'title_ky') ?>

    <?php // echo $form->field($model, 'text_ky') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
