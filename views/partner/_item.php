<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="parnter-index-text">
            <div class="text show-more-height">
                <?= $model->text; ?>
            </div>
            <div class="show-more"><?= Yii::t('app', 'Показать все') ?></div>
        </div>
    </div>

    <div class="col-lg-3">
        <?= Html::img($model->getWallpaper(), ['class' => 'partner-index-img']); ?>
    </div>
</div>
