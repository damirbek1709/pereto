<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <span class="btn btn-kyrgyz btn-info">
            Кыргызский контент <span class="fas fa-plus"></span>
        </span>

        <span class="btn btn-english btn-info">
            Английский контент <span class="fas fa-plus"></span>
        </span>
    </div>

    <div class="kyrgyz-block">
        <?= $form->field($model, 'meta_title_ky')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_description_ky')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_keywords_ky')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'text_ky')->textarea(['rows' => 6]) ?>
    </div>

    <div class="english-block">
        <?= $form->field($model, 'meta_title_en')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_description_en')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_keywords_en')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'text_en')->textarea(['rows' => 6]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    $('.btn-kyrgyz').on('click', function() {
        var child = $(this).find('.fas');
        var cousine = $('.btn-english').find('.fas');
        if (child.hasClass('fa-plus')) {
            if (cousine.hasClass('fa-minus')) {
                cousine.removeClass('fa-minus').addClass('fa-plus');
                $('.english-block').slideUp();
            }
            $('.kyrgyz-block').slideDown();
            child.removeClass('fa-plus').addClass('fa-minus');
        } else {
            $('.kyrgyz-block').slideUp();
            child.removeClass('fa-minus').addClass('fa-plus');
        }
    });
    $('.btn-english').on('click', function() {
        var child = $(this).find('.fas');
        var cousine = $('.btn-kyrgyz').find('.fas');
        if (child.hasClass('fa-plus')) {
            if (cousine.hasClass('fa-minus')) {
                $('.kyrgyz-block').slideUp();
                cousine.removeClass('fa-minus').addClass('fa-plus');
            }
            $('.english-block').slideDown();
            child.removeClass('fa-plus').addClass('fa-minus');
        } else {
            $('.english-block').slideUp();
            child.removeClass('fa-minus').addClass('fa-plus');
        }
    });
</script>