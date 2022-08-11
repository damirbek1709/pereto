<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\News;
?>

<link rel="stylesheet" href="<?= Url::base(); ?>/js/lightslider/src/css/lightslider.css" />
<?php
$lang = Yii::$app->language;
$title = 'title';
if ($lang != 'ru') {
    $title = 'title_' . $lang;
}
$query = News::find()->orderBy(['date' => SORT_DESC]);
$news = ArrayHelper::map($query->all(), 'id', $title);
$i = 0;
$cells = [];

$quieries = $query->all();
foreach ($quieries as $news_item) {
    $cells[] = ['id' => $news_item->id, 'title' => $news_item->title, 'image' => $news_item->getWallpaper()];
}
$result_arr = array_chunk($cells, 3, true);
?>
<link rel='stylesheet' href='<?= Url::base() ?>/js/slick/slick.css'>
<link rel='stylesheet' href='<?= Url::base() ?>/js/slick/slick-theme.css'>
<div class="news-wide-container news-index-grid">
    <div class="container">
        <h1 class="new-heading"><?= Yii::t('app', 'Новости') ?></h1>
        <div class="demo">
            <div class="news-slider-list">
                <ul id="content-slider" class="content-slider">
                    <?php
                    foreach ($result_arr as $key => $val) {
                        echo Html::beginTag('li', ['class' => 'item']);
                        echo Html::beginTag('div', ['class' => 'grid-container']);
                        $item = 1;
                        foreach ($val as $sub_key => $sub_val) {
                            if (!$sub_val[$title]) {
                                $title = 'title';
                            }
                            echo Html::beginTag('div', ['class' => 'slider-news-block item' . $item]);
                            echo Html::beginTag('a', ['href' => Url::base() . '/news/' . $sub_val['id']]);
                            echo Html::beginTag('div', ['class' => "news-img-cover", 'style' => "background-image:url(" . $sub_val['image'] . ")"]);
                            echo Html::tag('div', $sub_val[$title], ['class' => 'news-slider-title']);
                            echo Html::endTag('div');
                            echo Html::endTag('a');
                            echo Html::endTag('div');
                            $item++;
                        }
                        echo Html::endTag('div');
                        echo Html::endTag('li');
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="<?= Url::base() ?>/js/slick/slick.min.js"></script>
<script src="<?= Url::base() ?>/js/gallery.js"></script>

<style>
    .news-index-grid .grid-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(5, 1fr);
    }

    .news-index-grid .item1 {
        width: 100%;height: 240px;
    }
    .news-index-grid .news-slider-list{
        height: 100%;
    }

    .item1 { grid-area: 1 / 1 / 2 / 6; }
    .item2 { grid-area: 2 / 1 / 3 / 6; }
    .item3 { grid-area: 3 / 1 / 4 / 6; }
</style>

<script>
    $(document).ready(function() {
        $('.content-slider').slick({
            slidesToShow: 1,
            infinite: false,
            slidesToScroll: 1,
            //asNavFor: '.news-wide-container',
            dots: false,
            responsive: [
                // {
                //     breakpoint: 1024,
                //     settings: {
                //         slidesToShow: 3,
                //         slidesToScroll: 3,
                //         infinite: true,
                //         dots: true
                //     }
                // },
                // {
                //     breakpoint: 600,
                //     settings: {
                //         slidesToShow: 2,
                //         slidesToScroll: 2
                //     }
                // },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows:false,
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            // focusOnSelect: true
        });
    });
</script>