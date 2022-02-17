<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Тест по гендерным курсам';
?>

<div class="modal-body">
    <?php
    foreach ($data as $key => $val) {
        echo Html::tag('div', $val['question'], ['class' => 'result-question']);
        
        echo Html::tag('div', $val['answer'], ['class' => 'result-answer']);

        echo Html::beginTag('div', ['class' => 'comments-wrap']);
        echo Html::beginTag('div', ['class' => 'result-comments']);
        echo Html::beginTag('p', []);
        echo Html::beginTag('strong', []);
        echo Yii::t('app', 'Оценка').':';
        echo Html::endTag('strong');
        echo $val['assessment'];
        echo Html::endTag('p');
        echo Html::endTag('div');
        echo Html::endTag('div');

        echo Html::beginTag('div', ['class' => 'comments-wrap']);
        echo Html::beginTag('p');
        echo Html::beginTag('strong', []);
        echo Yii::t('app', 'Подсказки').':';
        echo Html::endTag('strong');
        echo $val['hint'];
        echo Html::endTag('p');
        echo Html::endTag('div');
    }
    ?>
    
</div>