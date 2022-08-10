<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $item->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 class="new-heading about-heading"><?= Html::encode($item->title) ?></h1>    
    <div class="row top-margin-20">
        <div class="col-lg-12"><?= $item->text; ?></div>
    </div>
</div>
