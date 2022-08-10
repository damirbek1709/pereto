<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="footer-heading">
                    <?= Html::img(Url::base() . "/images/logo_white.svg") ?>
                </div>
                <div class="footer-list">
                    <p><?= Yii::t('app', 'Pereto project') ?></p>
                    <p><?= Yii::t('app', 'Адрес: Кыргызская Республика, Бишкек, ул. Аалы Токомбаева 7/6') ?></p>
                    <p>+996 (312) 915000</p>
                    <p>pereto@auca.kg</p>
                </div>
            </div>

            <div class="col-lg-3 footer-links">

                <div class="footer-list-2" style="font-size: 14px">
                    <p><?= Html::a(Yii::t('app', 'О Проекте'), ['/about']); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Потребителям'), ['/libraries']); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Бизнес'), ['/reports']); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Новости'), ['/news']); ?></p>
                    <p><?= Html::a(Yii::t('app', 'Green Tips'), ['/gallery']); ?></p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="social_icons">
                    <?= Html::a('<i class="fab fa-instagram"></i>', 'https://www.instagram.com/pereto_project_kg/',['target'=>'_blank']); ?>
                    <?= Html::a('<i class="fab fa-youtube"></i>', 'https://www.youtube.com/channel/UClI1c5zMkJAahJD9xzOti9Q/featured',['target'=>'_blank']); ?>
                    <?= Html::a('<i class="fab fa-facebook-f"></i>', 'https://www.facebook.com/PERETO.project.kg',['target'=>'_blank']); ?>

                </div>
                <div class="footer_copyright">
                    Copyright 2022 Pereto KG, Terms & Privacy
                </div>
            </div>
        </div>

    </div>
</footer>