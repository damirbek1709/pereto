<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Slider;
use app\models\News;
use app\models\Page;
use yii\widgets\ListView;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */

$this->title = 'ПЭРЭТО (PERETO)';
$class = "padder-fixed";

if (!Yii::$app->user->isGuest) {
    $class = "padder-free";
}
if (!Yii::$app->user->isGuest) {
    $class = "padder-free";
}

$this->registerMetaTag(['name' => 'description', 'content' => 'Проект по продвижению энерго- и ресурсоэффективности в туристической отрасли Кыргызстана']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Кыргызстан, Кыргызстане Зелёный туризм, Устойчивое потребление, Устойчивое производство, Энергоэффективность, Ресурсоэффективность, Туристическая отрасль, Туристический сектор, Туристические МСП, УПП, ЭРЭ, HoReCa, ХоРеКа, Потребители, Экономия ресурсов, Зеленое финансирование, Энергоаудит, Ресурсоаудит, Консультации, Американский Университет в Центральной Азии, Воздействие на окружающую среду']);
?>

<link rel='stylesheet' href='<?= Url::base() ?>/js/slick/slick.css'>
<link rel='stylesheet' href='<?= Url::base() ?>/js/slick/slick-theme.css'>

<div class="site-index">
    <?= $this->render('slider',['language'=>Yii::$app->language]); ?>
</div>

<?php
$about = Page::findOne(1);
$about->translate(Yii::$app->language);
?>
<div class="container">
    <div class="body-content">
        <div class="site-index-news">
            <div class="site-about-project"></div>
            <h1 class="new-heading about-heading"><?= Yii::t('app', 'About project') ?></h1>
            <div class="index-project-desc">
                <div class="index-project-text">
                    <?php echo $about->description; ?>
                    <div class="about-links">
                        <?= Html::a(Yii::t('app', 'Описание проекта(скачать)'), 'https://pereto.kg/images/site/redactor/61c1b091a2702.pdf', ['class' => 'download-link','target'=>'_blank']); ?>
                        <?= Html::a(Yii::t('app', 'Подробнее'), ['/site/about'], ['style' => 'float:right', 'class' => 'readmore-link',]); ?>
                    </div>
                </div>
                <div class="index-project-img"><?php echo Html::img($about->getWallpaper(), ['class' => 'site-about-img']); ?></div>
            </div>
        </div>
    </div>
</div>

<?//= $this->render('news_2'); ?>
<?= $this->render('news',['language'=>Yii::$app->language]); ?>
<?= $this->render('self-esteem'); ?>
<?= $this->render('library'); ?>
<?= $this->render('partners'); ?>
<?= $this->render('video_2'); ?>


<script src="<?= Url::base() ?>/js/slick/slick.min.js"></script>
<script src="<?= Url::base() ?>/js/gallery.js"></script>

<script>
    var Slider = (function() {
        var initSlider = function() {
            var dir = $("html").attr("dir");
            var swipeHandler = new Hammer(document.getElementById("slider"));
            swipeHandler.on('swipeleft', function(e) {
                if (dir == "rtl")
                    $(".arrow-left").trigger("click");
                else
                    $(".arrow-right").trigger("click");
            });

            swipeHandler.on('swiperight', function(e) {
                if (dir == "rtl")
                    $(".arrow-right").trigger("click");
                else
                    $(".arrow-left").trigger("click");
            });

            $(".arrow-right , .arrow-left").click(function(event) {
                var nextActiveSlide = $(".slide.active").next();

                if ($(this).hasClass("arrow-left"))
                    nextActiveSlide = $(".slide.active").prev();

                if (nextActiveSlide.length > 0) {
                    var nextActiveIndex = nextActiveSlide.index();
                    $(".dots span").removeClass("active");
                    $($(".dots").children()[nextActiveIndex]).addClass("active");
                    updateSlides(nextActiveSlide);
                }
            });

            $(".dots span").click(function(event) {
                var slideIndex = $(this).index();
                var nextActiveSlide = $($(".slider").children()[slideIndex]);
                $(".dots span").removeClass("active");
                $(this).addClass("active");

                updateSlides(nextActiveSlide);
            });

            var updateSlides = function(nextActiveSlide) {
                var nextActiveSlideIndex = $(nextActiveSlide).index();

                $(".slide").removeClass("prev-1");
                $(".slide").removeClass("next-1");
                $(".slide").removeClass("active");
                $(".slide").removeClass("prev-2");
                $(".slide").removeClass("next-2");

                nextActiveSlide.addClass("active");

                nextActiveSlide.prev().addClass("prev-1");
                nextActiveSlide.prev().prev().addClass("prev-2");
                nextActiveSlide.addClass("active");
                nextActiveSlide.next().addClass("next-1");
                nextActiveSlide.next().next().addClass("next-2");
            }
            var updateToNextSlide = function(nextActiveSlide) {

            }
        }
        return {
            init: function() {
                initSlider();
            }
        }
    })();

    $(function() {
        Slider.init();
    });
</script>