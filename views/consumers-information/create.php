<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Consumer */

$this->title = Yii::t('app', 'Create Consumer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consumers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consumer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
