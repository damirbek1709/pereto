<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserTest */

$this->title = Yii::t('app', 'Create User Test');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
