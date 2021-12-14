<?php

use yii\helpers\Html; ?>
<div class="admin-block">
    <?
    echo Html::a('О проекте', ['/page/update/1']);
    echo Html::a('Новости', ['/news/admin']);
    echo Html::a('Слайдер', ['/slider/admin']);
    echo Html::a('Партнеры', ['/partner/admin']);
    echo Html::a('Потребители', ['/consumers-information/admin']);
    echo Html::a('Бизнес', ['/business-information/admin']);
    echo Html::a('Библиотека', ['/business-information/admin']);
    echo Html::a('Публикации', ['/reports/admin']);
    echo Html::a('Фото', ['/gallery/admin']);
    echo Html::a('Видео', ['/video/admin']);
    echo Html::a('Выйти', ['/site/logout'],['style'=>'float:right','data-method'=>'post']);
    ?>
</div>