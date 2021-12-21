<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<footer class="footer">
    <div class="footer-top col-lg-12">
        <div class="row">
            <div class="col-lg-5">
                <div class="footer-heading">
                    <?= Yii::t('app', 'Contacts') ?>
                </div>
                <div class="footer-list">
                    <p><?= Yii::t('app', 'Pereto project') ?></p>
                    <p><?= Yii::t('app', 'Адрес: Кыргызская Республика, Бишкек, ул. Аалы Токомбаева 7/6') ?></p>
                    <p>+996 (312) 915000</p>
                    <p>info@pereto.kg</p>
                </div>
            </div>
            <div class="col-lg-4 footer-links">
                <div class="footer-heading">
                    <?= Yii::t('app', 'Useful links') ?>
                </div>
                <div class="footer-list">
                    <p><?= Html::a(Yii::t('app', 'Инструмент самооценки'), 'https://www.pereto.kg/businesses-information/selfassessment_tools'); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Библиотека'), 'https://www.pereto.kg/libraries'); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Публикации'), 'https://www.pereto.kg/reports'); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Новости'), 'https://www.pereto.kg/news'); ?></p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-heading">
                    <?= Yii::t('app', 'Subscribe us') ?>
                </div>
                <div class="social_icons">
                    <?= Html::a('<i class="fab fa-instagram"></i>', 'https://www.instagram.com/pereto_project_kg/'); ?>
                    <?= Html::a('<i class="fab fa-youtube"></i>', 'https://www.youtube.com/channel/UClI1c5zMkJAahJD9xzOti9Q/featured'); ?>
                    <?= Html::a('<i class="fab fa-twitter"></i>', 'https://twitter.com/PeretoKg?fbclid=IwAR1Wn7G9ilnpmZNW7F23Ts93ZjylfYRBQ7N0anEbU_6uOZr8VyQUkthC1uE'); ?>
                    <?= Html::a('<i class="fab fa-facebook-f"></i>', 'https://www.facebook.com/PERETO.project.kg'); ?>
                    <?= Html::a('<i class="fab fa-telegram-plane"></i>', 'https://t.me/peretokg'); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-2 switch-asia">
                    <?=Html::img(Url::base().'/images/euro_big.jpg');?>
                </div>
                <div class="col-lg-10">
                    <?php
                    $string = ' This website was created and maintained with the financial support of the European Union. Its contents are the sole responsibility of PERETO and do not necessarily reflect the views of the European Union.';
                    echo Yii::t('app',$string);
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>