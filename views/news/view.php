<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">
    <div class="row">
        <div class="col-lg-9">
            <?= Html::img($model->getWallpaper(), ['class' => 'news-view-img']); ?>
            <div class="news-view-title">
                <?= $model->title; ?>
            </div>
            <div class="news-view-date">
                <?= date('d-m-Y', strtotime($model->date)); ?>
            </div>
            <div class="news-view-text">
                <?= $model->text; ?>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="news-other-block">
                <div class="other-news-header">
                    <?= Yii::t('app', 'Other news'); ?>
                </div>
                <div class="other-news-list">
                    <?php $news = $model->getOtherNews();
                    foreach ($news as $item) {
                        echo Html::tag('div', date('d-m-Y', strtotime($model->date)), ['class' => 'news-other-date']);
                        echo Html::a(Html::tag('div', $item->title), ['/news/view', 'id' => $item->id], ['class' => 'other-news-title']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>