<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use karpoff\icrop\CropImageUpload;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'photo')->widget(CropImageUpload::className()) ?>
    <?=
    $form->field($model, 'description')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'formatting' => ['p', 'blockquote', 'h2'],
            'plugins' => [
                'clips',
                'fullscreen',
                'table',
                'fontsize',
                'fontcolor',
            ]
        ],
    ]); ?>
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
        <?=
        $form->field($model, 'description_ky')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'formatting' => ['p', 'blockquote', 'h2'],
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'table',
                    'fontsize',
                    'fontcolor',
                ]
            ],
        ]); ?>
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
        <?=
        $form->field($model, 'description_en')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'formatting' => ['p', 'blockquote', 'h2'],
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'table',
                    'fontsize',
                    'fontcolor',
                ]
            ],
        ]); ?>
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

    <?= $form->errorSummary($model); ?>

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