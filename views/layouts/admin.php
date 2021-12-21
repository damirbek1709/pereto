<?php

use yii\helpers\Html; ?>
<div class="admin-block">
    <?
    echo Html::a(Yii::t('app','О проекте'), ['/page/update/1']);
    echo Html::a(Yii::t('app','Новости'), ['/news/admin']);
    echo Html::a(Yii::t('app','Слайдер'), ['/slider/admin']);
    echo Html::a(Yii::t('app','Партнеры'), ['/partner/admin']);
    echo Html::a(Yii::t('app','Потребителям'), ['/consumers-information/admin']);
    echo Html::a(Yii::t('app','Бизнес'), ['/businesses-information/admin']);
    echo Html::a(Yii::t('app','Библиотека'), ['/libraries/admin']);
    echo Html::a(Yii::t('app','Публикации'), ['/reports/admin']);
    echo Html::a(Yii::t('app','Фото'), ['/gallery/admin']);
    echo Html::a(Yii::t('app','Видео'), ['/video/admin']);
    echo Html::a(Yii::t('app','Выйти'), ['/site/logout'],['style'=>'float:right','data-method'=>'post']);
    ?>
</div>