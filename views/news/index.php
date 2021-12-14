<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <h1 class="main-heading"><?= Html::encode($this->title) ?></h1>
    <?php echo ListView::widget([
        'options' => [
            'class' => 'program-list row',
        ],
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summary' => false,
        'itemOptions' => [
            'class' => 'news-index-block justify-content-center align-items-center col-lg-6',
        ],
    ]); ?>
</div>