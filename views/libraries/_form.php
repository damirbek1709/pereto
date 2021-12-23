<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;;

use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use karpoff\icrop\CropImageUpload;
use app\models\LibraryCategory;
use app\models\LibraryTag;
use app\models\LibraryType;
use kartik\select2\Select2;

$cats = ArrayHelper::map(LibraryCategory::find()->all(), 'id', 'title');
$tags = ArrayHelper::map(LibraryTag::find()->all(), 'id', 'title');
$types = ArrayHelper::map(LibraryType::find()->all(), 'id', 'title');

/* @var $this yii\web\View */
/* @var $model app\models\Libraries */
/* @var $form yii\widgets\ActiveForm */
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="libraries-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textArea([]) ?>
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
    $model->category_id = $model->categoryTags;
    foreach ($cats as $d)
        $row[] = $d;
    echo $form->field($model, 'category_id')->widget(Select2::classname(), [
        'name' => 'category_id[]',
        'data' => $cats,
        'options' => ['placeholder' => 'Категории'],
        'pluginOptions' => [
            //'tags' => $row,
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

    <?php
    $model->type_id = $model->typeTags;
    foreach ($types as $d)
        $row_types[] = $d;
    echo $form->field($model, 'type_id')->widget(Select2::classname(), [
        'name' => 'type_id[]',
        'data' => $types,
        'options' => ['placeholder' => 'Типы'],
        'pluginOptions' => [
            //'tags' => $row_types,
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

    <?php
    $model->tag_id = $model->dropTags;
    foreach ($tags as $d)
        $row_drop[] = $d;
    echo $form->field($model, 'tag_id')->widget(Select2::classname(), [
        'name' => 'type_id[]',
        'data' => $tags,
        'options' => ['placeholder' => 'Тэги'],
        'pluginOptions' => [
            //'tags' => $row_drop,
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $('.js-example-basic-multiple').select2();

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