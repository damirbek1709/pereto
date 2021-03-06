<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Libraries */

$this->title = Yii::t('app', 'Create Libraries');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libraries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libraries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
