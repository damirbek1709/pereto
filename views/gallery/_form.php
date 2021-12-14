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
    $savedImagesCaption = [];
    if ($model->isNewRecord) {
        $image_val = null;
        $savedImages = [];
    } else {
        $image_val = $model->id;
        $savedImages = $model->getThumbImages();
        $captionArr = $model->getThumbs();

        if (count($captionArr)) {
            foreach ($captionArr as $image) {
                $savedImagesCaption[] = [
                    "caption" => basename($image),
                    "url" => Yii::$app->urlManager->createUrl('/gallery/remove-image'),
                    'key' => basename($image),
                    'extra' => ['id' => $model->id],
                ];
            }
        }
    }
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

<script>
    var main_img = "<?=$model->main_img?>";
    $(".kv-file-remove[data-key='" + main_img + "']").css('display','none');
    $('body').on('click', '.kv-cust-btn', function () {
        var main_val = $(this).siblings('.kv-file-remove').attr('data-key');
        $('.set-main').val(main_val);
        $('.kv-cust-btn').removeClass('main-selected');
        $(this).addClass('main-selected');
    });
</script>