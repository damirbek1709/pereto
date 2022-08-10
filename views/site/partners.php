<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="site-partners">
    <div class="container">
        <h1 class="new-heading"><?= Yii::t('app', 'Партнеры') ?></h1>
    </div>
    <div class="site-partners-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="site-partner-block">
                        <?= Html::a(Html::img(Url::base() . '/images/partners/auca.png'), 'https://www.auca.kg/', ['target' => '_blank']); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="site-partner-block">
                        <?= Html::a(Html::img(Url::base() . '/images/partners/unison.png'), 'https://unisongroup.org/', ['target' => '_blank']); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="site-partner-block">
                        <?= Html::a(Html::img(Url::base() . '/images/partners/technopolis.png'), 'https://www.technopolis-group.com/', ['target' => '_blank']); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="site-partner-block">
                        <?= Html::a(Html::img(Url::base() . '/images/partners/cscp.png'), 'https://www.cscp.org/', ['target' => '_blank']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>