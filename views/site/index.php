<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Slider;
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'Pereto.kg';
$class = "padder-fixed";
if(!Yii::$app->user->isGuest){
    $class = "padder-free";
}
?>
<link rel='stylesheet' href='<?= Url::base() ?>/css/slick.min.css'>
<link rel="stylesheet" href="<?= Url::base() ?>/css/gallery.css">
<div class="site-index">
    <div class="<?=$class?>">
        <div class="slide-cover">
            <div class="slick-carousel">
                <?php
                $sliders = Slider::find()->all();
                foreach ($sliders as $item) {
                    echo Html::tag('div', Html::a(Html::img($item->getWallpaper()), []), ['class' => 'slider-img-cover']);
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="body-content">
            <div class="site-index-news">
                <h1 class="main-heading"><?= Yii::t('app', 'News') ?></h1>
                <?php echo ListView::widget([
                    'options' => [
                        'class' => 'program-list row',
                    ],
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'summary' => false,
                    'itemOptions' => [
                        'class' => 'news-index-block justify-content-center align-items-center col-lg-4',
                    ],
                ]); ?>
                <div class="news-btn-group">
                    <?= Html::a('All News', ['/news/index'], ['class' => 'news-btn news-more-btn']); ?>
                    <?= Html::a('Subscribe', ['/news/subscribe'], ['class' => 'news-btn news-subscribe-btn']); ?>
                </div>
            </div>

            <div class="site-partners top-margin-30">
                <h1 class="main-heading"><?= Yii::t('app', 'Partners') ?></h1>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="site-partner-block">
                            <?= Html::a(Html::img(Url::base() . '/images/partners/american_u.png'), 'https://www.auca.kg/'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="site-partner-block">
                            <?= Html::a(Html::img(Url::base() . '/images/partners/unison_logo.png'), 'https://unisongroup.org/'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="site-partner-block">
                            <?= Html::a(Html::img(Url::base() . '/images/partners/technopolis.png'), 'https://www.technopolis-group.com/'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="site-partner-block">
                            <?= Html::a(Html::img(Url::base() . '/images/partners/cscp.png'), 'https://www.cscp.org/'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?= Url::base() ?>/js/slick.min.js"></script>
<script src="<?= Url::base() ?>/js/gallery.js"></script>