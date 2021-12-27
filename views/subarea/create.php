<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subarea */

$this->title = Yii::t('app', 'Create Subarea');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subareas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subarea-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
