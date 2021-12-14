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
$tags = LibraryTag::find()->all();
$types = LibraryType::find()->all();

/* @var $this yii\web\View */
/* @var $model app\models\Libraries */
/* @var $form yii\widgets\ActiveForm */
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="libraries-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
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
    foreach($cats as $d)
    $row[]=$d;
    echo $form->field($model, 'category_id')->widget(Select2::classname(), [
        'name' => 'category_id[]',
        'options' => ['placeholder' => 'Категории'],
        'pluginOptions' => [
            'tags' => $row,
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

    <div class="form-group field-libraries-type_id has-success">
        <label class="control-label" for="libraries-type_id">Тип</label>
        <select class="js-example-basic-multiple form-control" id="libraries-type_id" name="Libraries[type_id][]" multiple="multiple">
            <?php foreach ($types as $item) {
                echo "<option value={$item->id}>{$item->title}</option>";
            } ?>
        </select>
    </div>

    <div class="form-group field-libraries-tag_id has-success">
        <label class="control-label" for="libraries-tag_id">Тэги</label>
        <select class="js-example-basic-multiple form-control" id="libraries-tag_id" name="Libraries[tag_id][]" multiple="multiple">
            <?php foreach ($tags as $item) {
                echo "<option value={$item->id}>{$item->title}</option>";
            } ?>
        </select>
    </div>

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

    <?= $form->field($model, 'photo')->widget(CropImageUpload::className()) ?>

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