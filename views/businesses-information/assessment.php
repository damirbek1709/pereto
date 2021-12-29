<?php

use app\models\Business;
use app\models\BusinessType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Question;

/* @var $this yii\web\View */
/* @var $model app\models\Business */

$this->title = Yii::t('app', 'Инструмент Самооценки');
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$item = Business::findOne(5);
?>
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form></form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn show-results btn-primary"><?= Yii::t('app', 'Посмотреть результат'); ?></button>
                <button type="button" class="btn approve-question btn-primary pull-right"><?= Yii::t('app', 'Потвердить'); ?></button>
            </div>
        </div>
    </div>
</div>

<div class="business-view">
    <h1 class="main-heading"><?= Html::encode($this->title) ?></h1>
    <div class="row top-margin-20">
        <div class="col-lg-12">
            <div class="business_text"><?= $item->text ?></div>
            <div class="business_form">
                <div class="user-test-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($test, 'email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($test, 'organization_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($test, 'buisness_type')->dropDownList(ArrayHelper::map(BusinessType::find()->all(), 'id', 'title')); ?>
                    <div class="form-group">
                        <?= Html::button(Yii::t('app', 'Begin Test'), ['class' => 'test-begin btn-primary btn']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    var num_quest;
    var test_id;

    var name = $('#usertest-organization_name').val();
    var email = $('#usertest-email').val();
    var business_type = $('#usertest-buisness_type').val();

    $('.test-begin').on('click', function(e) {
        var name = $('#usertest-organization_name').val();
        var email = $('#usertest-email').val();
        var business_type = $('#usertest-buisness_type').val();

        if (name != "" && email != "" && business_type != "") {
            $.ajax({
                method: "POST",
                url: "<?= Yii::$app->urlManager->createUrl('/user-test/begin-test'); ?>",
                data: {
                    name: name,
                    email: email,
                    type: business_type,
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    num_quest = obj.id;
                    test_id = obj.test_id;
                    $('.modal-title').text(obj.title);
                    $.each(obj.answers, function(key, value) {
                        $('.modal-body').append('<div class="radio-flex"><input class="radio_option" type="radio" id="answer' + key + '" name="answer" value="' + key + '"><label for="answer' + key + '">' + value + '</label></div>');
                    });
                    $(".modal").modal('show');
                }
            });
        }
    });

    $(document).ready(function() {
        $('.approve-question').click(function() {
            var business_type = $('#usertest-buisness_type').val();
            if ($('.radio_option').is(':checked')) {
                var answer = $('input[name="answer"]:checked').val();
                $.ajax({
                    method: "POST",
                    url: "<?= Yii::$app->urlManager->createUrl('/user-test/next-question'); ?>",
                    data: {
                        type: business_type,
                        id: num_quest,
                        answer: answer,
                        test_id: test_id
                    },
                    success: function(response) {
                        var obj = JSON.parse(response);
                        num_quest = obj.id;
                        $('.modal-title').text(obj.title);
                        $('.modal-body').html('<form></form>');
                        $.each(obj.answers, function(key, value) {
                            $('.modal-body form').append('<div class="radio-flex"><input class="radio_option" type="radio" id="answer' + key + '" name="answer" value="' + key + '"><label for="answer' + key + '">' + value + '</label></div>');
                        });
                    }
                });
            }
        });

        $('.show-results').click(function() {
            $.ajax({
                method: "POST",
                url: "<?= Yii::$app->urlManager->createUrl('/user-test/show-results'); ?>",
                data: {
                    test_id: test_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    $('.modal-body').html('');
                    console.log(obj);
                    $.each(obj, function(key, value) {
                        $('.modal-body').append('<i class="fas fa-check"></i>');
                        $('.modal-body').append('<div class="result-question">' + value.question + '</div>');                       
                        $('.modal-body').append('<div class="comments-wrap"><div class="result-info-icon">i</div><div class="result-answer">' + value.answer + '</div><div class="result-comments">' + '<p>' + value.assessment + '</p>' + '<p>' + value.hint + '</p>' + '</div></div>');
                        $('.modal-footer').html('');
                    });
                }
            });
        });
    });
</script>