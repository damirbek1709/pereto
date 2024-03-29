<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$h1_title = Yii::t('app', 'Publications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-index">
    <h1 class="new-heading about-heading"><?= Html::encode($h1_title) ?></h1>
    <?php echo ListView::widget([
        'options' => [
            'class' => 'report-list row',
        ],
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summary' => false,
        'itemOptions' => [
            'class' => 'report-index-block col-lg-4 col-md-4',
        ],
    ]); ?>
</div>