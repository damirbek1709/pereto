<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'question_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_ky') ?>

    <?= $form->field($model, 'title_en') ?>

    <?php // echo $form->field($model, 'assessment_ky') ?>

    <?php // echo $form->field($model, 'assessment_en') ?>

    <?php // echo $form->field($model, 'hint') ?>

    <?php // echo $form->field($model, 'hint_ky') ?>

    <?php // echo $form->field($model, 'hint_en') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
