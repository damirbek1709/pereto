<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\App;
?>
<?php
$model->translate(Yii::$app->language);
$title = App::getLibraryTitle();
$library = $model;

echo Html::beginTag('div', ['class' => 'lib-index-block']);
$img = $library->getWallpaper();
echo Html::beginTag('a', ['href' => Url::base() . "/libraries/{$library->id}", 'class' => 'lib-index-img', 'style' => "background-image:url({$img})"]);
echo Html::beginTag('div', ['class' => 'lib-index-type']);
$types = $library->typeList;
foreach ($types as $key => $val) {
    echo $val[$title];
}
echo Html::endTag('div');
echo Html::endTag('a');

echo Html::beginTag('div', ['class' => 'lib-index-right']);
echo Html::a($library->title, ["/libraries/view", "id" => $library->id], ['class' => 'lib-index-title']);
echo Html::tag('div', StringHelper::truncateWords($library->description, 12, $suffix = '...'), ['class' => 'lib-index-desc']);
echo Html::beginTag('div', ['class' => 'lib-index-cats']);
$cats = $library->catList;
foreach ($cats as $key => $val) {
    echo "<span>" . $val[$title] . $concat_string . "</span>";
}
echo Html::endTag('div');
echo Html::a(Yii::t('app', 'Подробнее'), ['/libraries/view', 'id' => $library->id], ['class' => 'lib-readmore']);
echo Html::endTag('div');
echo Html::endTag('div');

?>
