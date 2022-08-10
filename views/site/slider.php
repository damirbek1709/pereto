<?php

use app\models\Slider;
use yii\helpers\Html;
?>
<div class="slider_bg">
    <div class="slider-container">
        <span class="arrow-left"></span>
        <span class="arrow-right"></span>
        <div class="slider" id="slider">
            <?php
            $slides = Slider::find()->orderBy(['id' => SORT_DESC])->all();
            $counter = 1;
            $class = 'prev-1';
            foreach ($slides as $item) {
                $item->translate($language);
                if ($counter == 1) {
                    $class = 'prev-1';
                } elseif ($counter == 2)
                    $class = 'active';
                elseif ($counter == 3) {
                    $class = 'next-1';
                } else $class = '';

                $img = $item->getWallpaper();
                echo Html::beginTag('div', ['class' => "slide {$class}", 'style' => "background-image:url({$img})"]);
                echo Html::beginTag('div', ['class' => "hummer_slogan"]);
                echo Html::tag('div', 'ПЭРЭТО / PERETO', ['class' => 'hummer_slogan_big']);
                echo Html::tag('div', $item->title, ['class' => '']);
                echo Html::endTag('div');
                echo Html::endTag('div');
                $counter++;
            }
            ?>
        </div>

        <div class="dots">
            <?
            $counter = 1;
            $active = '';
            foreach ($slides as $item) {
                if ($counter == 2)
                    $active = 'active';
                else $active = '';
                echo Html::tag('span', '', ['class' => $active]);
                $counter++;
            }
            ?>
        </div>
    </div>
</div>