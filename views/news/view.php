<script src="https://yastatic.net/share2/share.js"></script>
<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
            <div class="main-heading">
                <?= $model->title; ?>
            </div>
            <?//= Html::img($model->getWallpaper(), ['class' => 'news-view-img']); ?>
            
            <div class="news-view-date">
                <?= date('d-m-Y', strtotime($model->date)); ?>
            </div>
            <div class="news-view-text">
                <?= $model->text; ?>
            </div>
            <?=$this->render('gallery',['model'=>$model])?>
            
            <div class="social_share">
                <div class="ya-share2" data-title="<?= $model->title; ?>" data-curtain data-services="vkontakte,facebook,odnoklassniki,telegram,twitter,whatsapp"></div>
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
                        $item->translate(Yii::$app->language);
                        echo Html::tag('div', date('d-m-Y', strtotime($item->date)), ['class' => 'news-other-date']);
                        echo Html::a(Html::tag('div', $item->title), ['/news/view', 'id' => $item->id], ['class' => 'other-news-title']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

