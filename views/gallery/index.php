<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1 class="main-heading"><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo ListView::widget([
        'options' => [
            'class' => 'gallery-list row',
        ],
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summary' => false,
        'itemOptions' => [
            'class' => 'gallery-index-block col-lg-3',
        ],
    ]); ?>


</div>
