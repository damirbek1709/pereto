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
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_ky')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'priority')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList($model->getTypeList()); ?>
    <?= $form->field($model, 'photo')->widget(CropImageUpload::className()) ?>
    <?= $form->field($model, 'embed')->textArea() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    if ($('#slider-type').val() == 0) {
        $('.field-slider-embed').css('display', 'none');
        $('.field-slider-photo').css('display', 'block');
    } else {
        $('.field-slider-embed').css('display', 'block');
        $('.field-slider-photo').css('display', 'none');
    }
    $('#slider-type').change(function() {
        if ($(this).val() == 0) {
            $('.field-slider-embed').css('display', 'none');
            $('.field-slider-photo').css('display', 'block');
        } else {
            $('.field-slider-embed').css('display', 'block');
            $('.field-slider-photo').css('display', 'none');
        }
    });
</script>