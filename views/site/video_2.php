<?php

use app\models\Video;
use yii\helpers\Url;
use yii\helpers\Html;

$videos = Video::find()->orderBy(['id' => SORT_DESC])->all();
?>
<div class="news-wide-container">
    <div class="container">
        <h1 class="new-heading"><?= Yii::t('app', 'Видео') ?></h1>
    </div>
    <div class="video-container">
        <div class="video-list-t">
            <?php
            foreach ($videos as $model) {
                $string = $model->source;
                $pattern = '!youtube.com/embed/([^"]+)!i';
                preg_match($pattern, $string, $match);
                if ($match[1]) {
                    $youtube_id = $match[1];
                }
                echo $model->translate(Yii::$app->language);
                echo Html::beginTag('div', ['href' => Url::to("/video/{$model->id}"), 'class' => 'video-b']);

                $video_img =  $model->getThumbUrl();
                echo Html::beginTag('div', ['class' => 'youtube-container']);
                echo Html::tag('div', $model->source, ['class' => "youtube-video"]);
                //echo Html::beginTag('div', ['class' => 'index-video-img', 'style' => "background-image:url({$video_img})", 'data-src' => $youtube_id]);
                //echo Html::img(Url::base() . '/images/site/video_play.svg');
                //echo Html::endTag('div');
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'video-index-title-grid']);
                echo Html::img(Url::base() . '/images/site/pereto_circle.svg');
                echo Html::beginTag('div', ['class' => '']);
                echo Html::tag('div', $model->title, ['class' => 'video-index-title']);
                echo Html::tag('div', 'Pereto KG | ПЭРЭТО КР', ['class' => 'video-index-desc']);
                echo Html::endTag('div');
                echo Html::endTag('div');
                echo Html::endTag('div');
            }
            ?>
        </div>
    </div>
</div>

<style>
    /* .video-b iframe {
        position: absolute;
        z-index: -1;
    } */
</style>


<script type="text/javascript" src="<?= Url::base() ?>/js/slick/slick.js"></script>
<script>
    $(document).ready(function() {
        // $('.youtube-container').click(function() {
        //     $(this).find('.index-video-img').remove();
        //     $(this).find('iframe').css('z-index', 1);
        // });
        $('.video-list-t').slick({
            slidesToShow: 2,
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