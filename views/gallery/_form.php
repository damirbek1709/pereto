<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ky')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'files[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg'],
            'initialPreview' => $savedImages,
            'initialCaption' => '',
            'uploadAsync' => false,
            //'deleteUrl'=>'/product/remove-image',
            //'data-key'=>[$savedImagesCaption,$model->id],
            'initialPreviewConfig' => $savedImagesCaption,
            'otherActionButtons' => "
                                <button type='button' class='kv-cust-btn btn btn-xs'>
                                    <i class='glyphicon glyphicon-ok'> Основной рисунок</i>
                                </button>
                                ",
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'overwriteInitial' => false,
            'fileActionSettings' => [
                'showZoom' => false,
                'indicatorNew' => '&nbsp;',
                'removeIcon' => '<span class="glyphicon glyphicon-trash" title="Удалить"></span> ',
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>