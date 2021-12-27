<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAnswer */

$this->title = Yii::t('app', 'Create User Answer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
