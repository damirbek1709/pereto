<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<?php echo Html::beginTag('a',['href'=>Url::to("/reports/{$model->id}"),'class'=>'reports-block-cover-link']);?>
<div class="row">
    <div class="col-lg-6">
        <div class="report-block-img" style="background-image:url(<?=$model->getWallpaper()?>)">
            <?//= Html::img($model->getWallpaper()); ?>
        </div>
    </div>

    <div class="col-lg-6">
        <?= Html::tag('div', $model->title, ['class'=>'reports-index-title']); ?>
        <?= Html::tag('div', date('d-m-Y',strtotime($model->date)), ['class'=>'reports-index-date']); ?>
    </div>
</div>
<?=Html::endTag('a');?>