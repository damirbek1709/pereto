<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<?php echo Html::beginTag('a',['href'=>Url::to("/video/{$model->id}"),'class'=>'']);?>
<?=$model->getMainThumb()?>
<?=Html::tag('div',$model->title,['class'=>'news-index-title']);?>
<?=Html::endTag('a');?>