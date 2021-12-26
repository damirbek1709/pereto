<?php

use app\models\Bridge;
use app\models\App;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Libraries */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libraries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="libraries-view">
    <div class="row">
        <div class="col-lg-12">
            <?= Html::img($model->getWallpaper(), ['class' => 'news-view-img']); ?>
            <div class="news-view-title">
                <?= $model->title; ?>
            </div>
            <div class="news-view-text">
                <?= $model->text; ?>
            </div>

            <div class="tags-cover">
                <div class="tags-block">
                    <?= Html::tag('span', Yii::t('app', 'Тэг') . ': ', ['class' => 'tag-heading']); ?>
                    <span class="tag-list">
                        <?php
                        $title = App::getLibraryTitle();
                        $tags = $model->tagList;
                        foreach ($tags as $key => $val) {
                            echo " / " . Html::a($val['title'], ['/libraries/index', 'tag' => $val['id']]) . "  ";
                        }
                        ?>
                </div>

                <div class="tags-block">
                    <?= Html::tag('span', Yii::t('app', 'Категория') . ': ', ['class' => 'tag-heading']); ?>
                    <span class="tag-list">
                        <?php
                        $cats = $model->catList;
                        foreach ($cats as $key => $val) {
                            echo " / " . Html::a($val['title'], ['/libraries/index', 'category' => $val['id']]) . "  ";
                        }
                        ?>
                    </span>
                </div>

                <div class="tags-block">
                    <?= Html::tag('span', Yii::t('app', 'Тип') . ': ', ['class' => 'tag-heading']); ?>
                    <span class="tag-list">
                        <?php
                        $types = $model->typeList;
                        foreach ($types as $key => $val) {
                            echo " / " . Html::a($val['title'], ['/libraries/index', 'type' => $val['id']]) . "  ";
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>