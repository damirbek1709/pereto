<?php
use yii\helpers\Html;
?>
<div class="self-esteem">
    <div class="container">
        <div class="row">
            <div class="left-esteem col-md-8">
                <div class="esteem-title">
                    <?= Yii::t('app', 'Инструмент самооценки для малых и средних предприятий'); ?>
                </div>
                <div class="line-break"></div>
                <div class="esteem-description">
                    <?= Yii::t('app', 'Проведите быструю первичную оценку текущей практики с точки зрения энерго- и ресурсоэффективности, а также устойчивого управления бизнесом.'); ?>
                </div>
            </div>
            <div class="right-esteem col-md-4">
                <?= Html::a(Yii::t('app', 'Пройти тест'), ['/businesses-information/selfassessment_tools']) ?>
            </div>
        </div>
    </div>
</div>