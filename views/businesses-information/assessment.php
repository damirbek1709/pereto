<?php

use app\models\Business;
use app\models\BusinessType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Business */

$this->title = Yii::t('app', 'Инструмент Самооценки');
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$item = Business::findOne(5);
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h5 class="modal-text-header"></h5>
                    <div class="btn-header-group">
                        <button type='button' disabled data-cat='1' class='show-results cat-management btn-primary btn'>Менеджмент</button>
                        <button type='button' disabled data-cat='2' class='show-results cat-materials btn-primary btn'>Материалы</button>
                        <button type='button' disabled data-cat='3' class='show-results cat-water btn-primary btn'>Вода</button>
                        <button type='button' disabled data-cat='4' class='show-results cat-waste btn-primary btn'>Отходы</button>
                        <button type='button' disabled data-cat='5' class='show-results cat-energy btn-primary btn'>Энергия</button>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form></form>
            </div>
            <div class="modal-footer">
                <button type="button" data-cat="1" class="btn show-results btn-primary"><?= Yii::t('app', 'Посмотреть результат'); ?></button>
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

            <div class="col-lg-10 progress-grid">
                <div class="progress-category-name">
                    Менеджмент
                    <div class="w3-light-grey w3-round">
                        <div class="Management w3-container w3-blue w3-round" data-key="Management" style="width:0"></div>
                    </div>
                </div>

                <div class="progress-category-name">
                    Материалы
                    <div class="w3-light-grey w3-round">
                        <div class="Materials w3-container w3-blue w3-round" data-key="Materials" style="width:0"></div>
                    </div>
                </div>

                <div class="progress-category-name">
                    Отходы
                    <div class="w3-light-grey w3-round">
                        <div class="Water w3-container w3-blue w3-round" data-key="Water" style="width:0"></div>
                    </div>
                </div>

                <div class="progress-category-name">
                    Вода
                    <div class="w3-light-grey w3-round">
                        <div class="Waste w3-container w3-blue w3-round" data-key="Waste" style="width:0"></div>
                    </div>
                </div>                

                <div class="progress-category-name">
                    Энергия
                    <div class="w3-light-grey w3-round">
                        <div class="Energy w3-container w3-blue w3-round" data-key="Energy" style="width:0"></div>
                    </div>
                </div>
            </div>
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
    var past_arr = [];

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
                    past_arr.push(obj.id);
                    test_id = obj.test_id;

                    $('.modal-text-header').css('display', 'block').text(obj.title);

                    $.each(obj.category_id, function(key, value) {
                        $(".show-results[data-cat='" + value + "']").attr('disabled', false);
                    });

                    $.each(obj.answers, function(key, value) {
                        $('.modal-body').append('<div class="radio-flex"><input class="radio_option" type="radio" id="answer' + key + '" name="answer" value="' + key + '"><label for="answer' + key + '">' + value + '</label></div>');
                    });
                    $('.modal-footer').css('display', 'block');
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
                        test_id: test_id,
                        past_arr: past_arr,
                    },
                    success: function(response) {
                        if (response == 'finished') {
                            $('.btn-header-group').css('display', 'block');
                            $('.modal-body').html('');
                            var category_id = 1;
                            $.ajax({
                                method: "POST",
                                url: "<?= Yii::$app->urlManager->createUrl('/user-test/show-results'); ?>",
                                data: {
                                    test_id: test_id,
                                    category_id: category_id,
                                },
                                success: function(response) {
                                    var obj = JSON.parse(response);
                                    $(".show-results[data-cat='" + obj.category_id + "']").attr('disabled', false);
                                    $('.modal-text-header').css('display', 'none');
                                    $('.btn-header-group').css('display', 'block');
                                    $('.modal-body').html('');
                                    $.each(obj, function(key, value) {
                                        $('.modal-body').append('<i class="fas fa-check"></i>');
                                        $('.modal-body').append('<div class="result-question">' + value.question + '</div>');
                                        $('.modal-body').append('<div class="comments-wrap"><div class="result-info-icon">i</div><div class="result-answer">' + value.answer + '</div><br><div class="result-comments">' + '<p><strong>Оценка: </strong>' + value.assessment + '</p>' + '<p><strong>Подсказки: </strong>' + value.hint + '</p>' + '</div></div>');
                                    });
                                    $('.modal-footer').css('display', 'none');
                                }
                            });
                        } else {
                            var obj = JSON.parse(response);
                            num_quest = obj.id;
                            $(".show-results[data-cat='" + obj.category_id + "']").attr('disabled', false);
                            past_arr.push(obj.id);
                            $('.modal-text-header').text(obj.title);
                            $('.modal-body').html('<form></form>');
                            $.each(obj.answers, function(key, value) {
                                $('.modal-body form').append('<div class="radio-flex"><input class="radio_option" type="radio" id="answer' + key + '" name="answer" value="' + key + '"><label for="answer' + key + '">' + value + '</label></div>');
                            });
                        }
                    }
                });
            }
        });
    });

    $('.show-results').on('click', function() {
        $('.btn-header-group').css('display', 'block');
        $('.modal-body').html('');
        var category_id = $(this).attr('data-cat');
        $.ajax({
            method: "POST",
            url: "<?= Yii::$app->urlManager->createUrl('/user-test/show-results'); ?>",
            data: {
                test_id: test_id,
                category_id: category_id,
            },
            success: function(response) {
                var obj = JSON.parse(response);
                $('.modal-text-header').css('display', 'none');
                $('.btn-header-group').css('display', 'block');
                $('.modal-body').html('');
                console.log(obj);
                $.each(obj, function(key, value) {
                    $('.modal-body').append('<i class="fas fa-check"></i>');
                    $('.modal-body').append('<div class="result-question">' + value.question + '</div>');
                    $('.modal-body').append('<div class="comments-wrap"><div class="result-info-icon">i</div><div class="result-answer">' + value.answer + '</div><br><div class="result-comments">' + '<p><strong>Оценка: </strong>' + value.assessment + '</p>' + '<p><strong>Подсказки: </strong>' + value.hint + '</p>' + '</div></div>');
                });
                $('.modal-footer').css('display', 'none');
            }
        });
    });

    $('.modal').on('hidden.bs.modal', function() {
        $('.modal-body').html('');
        $.ajax({
            method: "POST",
            data: {
                test_id: test_id,
            },
            url: "<?= Yii::$app->urlManager->createUrl('/user-test/change-progress'); ?>",
            success: function(response) {
                var obj = JSON.parse(response);
                $.each(obj, function(key, value) {
                    var progress = value;
                    $('.' + key).attr('style','width: ' + progress + '%');
                });
            }
        });
    });
</script>