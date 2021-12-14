<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use karpoff\icrop\CropImageUpload;

/* @var $this yii\web\View */
/* @var $model app\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">



    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>    

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox();?>

    <?= $form->field($model, 'photo')->widget(CropImageUpload::className()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>