<?php
use yii\helpers\Html;
use yii\helpers\Url;


$model->translate(Yii::$app->language);
$report = $model;

echo Html::beginTag('div', ['class' => 'rep-index-block']);
$img = $report->getWallpaper();
echo Html::beginTag('a', ['href' => Url::base() . "/reports/{$report->id}", 'class' => 'rep-index-img', 'style' => "background-image:url({$img})"]);

echo Html::endTag('a');

echo Html::beginTag('div', ['class' => 'rep-index-right']);
echo Html::a($report->title, ["/reports/view", "id" => $report->id], ['class' => 'lib-index-title']);
//echo Html::tag('div', StringHelper::truncateWords($report->description, 12, $suffix = '...'), ['class' => 'lib-index-desc']);
echo Html::beginTag('div', ['class' => 'lib-index-cats']);

echo Html::endTag('div');
//echo Html::a(Yii::t('app', 'Подробнее'), ['/libraries/view', 'id' => $report->id], ['class' => 'lib-readmore']);
echo Html::endTag('div');
echo Html::endTag('div');
