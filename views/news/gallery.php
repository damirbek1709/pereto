<?php
use yii\helpers\Url;
use yii\helpers\Html;
 ?>
<link rel="stylesheet"  href="<?= Url::base() ?>/js/lightslider/src/css/lightslider.css"/>
<script src="<?= Url::base() ?>/js/lightslider/src/js/lightslider.js"></script>  

<script>
    $(document).ready(function() {
        $('#image-gallery').lightSlider({
            gallery: true,
            item: 1,
            thumbItem: 5,
            slideMargin: 3,
            controls:false,
            speed: 500,
            auto: true,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });
    });
</script>

<div class="demo_gallery">
    <div class="item">
        <div class="clearfix" style="max-width:474px;">
            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                <?php
                foreach($model->getImages() as $thumb=>$img){
                    echo Html::beginTag('li',['data-thumb'=>$thumb]);
                    echo Html::img($img);
                    echo Html::endTag('li');
                }
                ?>
            </ul>
        </div>
    </div>
</div>