<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use karpoff\icrop\CropImageUpload;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textArea(); ?>

    <?=
    $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'formatting' => ['p', 'blockquote', 'h2'],
            'imageCaption' => true,
            'imageUpload' => Url::to(['site/image-upload']),
            'fileUpload' => Url::to(['site/file-upload']),

            'plugins' => [
                'imagemanager',
                'filemanager',
                'clips',
                'fullscreen',
                'table',
                'fontsize',
                'fontcolor',
                'video',
            ]
        ],
    ]); ?>

    <?php
    if ($model->isNewRecord) {
        $date_default = date('Y-m-d');
    } else {
        $date_default = $model->date;
    }
    ?>

    <?= $form->field($model, 'date')->textInput([
        'maxlength' => true,
        'type' => 'date',
        'value' => $date_default,
        'style' => 'width:200px'
    ]); ?>

    <?= $form->field($model, 'photo')->widget(CropImageUpload::className()) ?>

    <div class="form-group">
        <span class="btn btn-kyrgyz btn-info">
            Кыргызский контент <span class="fas fa-plus"></span>
        </span>

        <span class="btn btn-english btn-info">
            Английский контент <span class="fas fa-plus"></span>
        </span>
    </div>

    <div class="kyrgyz-block">
        <?= $form->field($model, 'title_ky')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description_ky')->textInput(['maxlength' => true]) ?>
        <?=
        $form->field($model, 'text_ky')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'formatting' => ['p', 'blockquote', 'h2'],
                'imageCaption' => true,
                'imageUpload' => Url::to(['site/image-upload']),
                'fileUpload' => Url::to(['site/file-upload']),

                'plugins' => [
                    'imagemanager',
                    'filemanager',
                    'clips',
                    'fullscreen',
                    'table',
                    'fontsize',
                    'fontcolor',
                    'video',
                ]
            ],
        ]); ?>
    </div>

    <div class="english-block">
        <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>
        <?=
        $form->field($model, 'text_en')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'formatting' => ['p', 'blockquote', 'h2'],
                'imageCaption' => true,
                'imageUpload' => Url::to(['site/image-upload']),
                'fileUpload' => Url::to(['site/file-upload']),

                'plugins' => [
                    'imagemanager',
                    'filemanager',
                    'clips',
                    'fullscreen',
                    'table',
                    'fontsize',
                    'fontcolor',
                    'video',
                ]
            ],
        ]); ?>
    </div>

    <div class="img-drop" style="font-family: Arial,sans-serif">
        <?php
        $savedImagesCaption = [];
        if ($model->isNewRecord) {
            $savedImages = [];
        } else {
            $savedImages = $model->getThumbImages();
            $captionArr = $model->getThumbs();
            if (count($model->getThumbs())) {
                foreach ($captionArr as $image) {
                    $savedImagesCaption[] = [
                        "caption" => basename($image),
                        "url" => Yii::$app->urlManager->createUrl('/news/remove-image'),
                        'key' => basename($image),
                        'extra' => ['id' => $model->id],
                    ];
                }
            }
        }
        echo $form->field($model, 'file[]')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg'],
                'initialPreview' => $savedImages,
                'initialCaption' => '',
                'uploadAsync' => false,
                'initialPreviewConfig' => $savedImagesCaption,                
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'overwriteInitial' => false,
                'fileActionSettings' => [
                    'showZoom' => false,
                    'indicatorNew' => '&nbsp;',
                    'removeIcon' => '<span class="glyphicon glyphicon-trash" title="Удалить">Удалить</span> ',
                ],
            ]
        ]);
        ?>
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