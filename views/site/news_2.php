<?php

use app\models\Video;
use app\models\News;
use yii\helpers\Url;
use yii\helpers\Html;

$videos = Video::find()->orderBy(['id' => SORT_DESC])->all();
$news = News::find()->orderBy(['date' => SORT_DESC])->all();
?>
<div class="news-wide-container">
    <div class="container">
        <h1 class="new-heading"><?= Yii::t('app', 'Новости') ?></h1>
    </div>
    <div class="video-container">
        <div class="news-list-t">
            <?php
            $item = 1;
            foreach ($news as $model) {
                echo $model->translate(Yii::$app->language);
                echo Html::beginTag('a', ['href' => Url::to("/news/{$model->id}"), 'class' => "news-b {$item}"]);
                echo Html::beginTag('div', ['class' => "news-img-cover", 'style' => "background-image:url(" . $model->getWallpaper() . ")"]);
                echo Html::tag('div', $model->title, ['class' => 'news-slider-title']);
                echo Html::endTag('div');
                echo Html::endTag('a');
                $item++;
            }
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.news-list-t').slick({
            slidesToShow: 3,
            infinite: false,
            slidesToScroll: 1,
            // asNavFor: '.news-wide-container',
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
                        slidesToScroll: 1
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