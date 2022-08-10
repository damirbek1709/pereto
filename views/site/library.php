<?php

use app\models\App;
use app\models\Libraries;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\Html;

$libraries = Libraries::find()->orderBy(['id' => SORT_DESC])->limit(2)->all();
$title = App::getLibraryTitle();
?>
<div class="library-section">
    <div class="container">
        <div class="pull-left">
            <h1 class="new-heading"><?= Yii::t('app', 'Библиотека') ?></h1>
        </div>

        <div class="pull-right lib-readall">
            <?= Html::a(Yii::t('app', 'Посмотреть все'), ['/libraries'],['class'=>'lib-index-all']); ?>
        </div>
        <div class="library-description">
            <?= Yii::t('app', 'Библиотека ПЭРЭТО — это собрание передовых практик, применяемых малыми и средними предприятиями ХоРеКа в Кыргызстане и в мире. Он демонстрирует разнообразие возможных решений и практик, которые приводят к экономии ресурсов, экономической эффективности и получению зеленого имиджа среди клиентов.') ?>
        </div>

        <div class="library-grid">
            <?php
            foreach ($libraries as $library) {
                echo Html::beginTag('div', ['class' => 'lib-index-block']);
                $img = $library->getWallpaper();
                echo Html::beginTag('a', ['href' => Url::base() . "/libraries/{$library->id}",'class' => 'lib-index-img', 'style' => "background-image:url({$img})"]);                
                echo Html::beginTag('div', ['class' => 'lib-index-type']);
                $types = $library->typeList;
                foreach ($types as $key => $val) {
                    echo $val[$title];
                }
                echo Html::endTag('div');
                echo Html::endTag('a');

                echo Html::beginTag('div', ['class' => 'lib-index-right']);
                echo Html::a($library->title, ["/libraries/view","id"=>$library->id],['class' => 'lib-index-title']);
                echo Html::tag('div', StringHelper::truncateWords($library->description, 12, $suffix = '...'), ['class' => 'lib-index-desc']);
                echo Html::beginTag('div', ['class' => 'lib-index-cats']);
                $cats = $library->catList;
                foreach ($cats as $key => $val) {
                    echo "<span>" . $val[$title] . $concat_string . "</span>";
                }
                echo Html::endTag('div');
                echo Html::a(Yii::t('app','Подробнее'),['/libraries/view','id'=>$library->id],['class'=>'lib-readmore']);
                echo Html::endTag('div');
                echo Html::endTag('div');
            }
            ?>
        </div>
    </div>
</div>