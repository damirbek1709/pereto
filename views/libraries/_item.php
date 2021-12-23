<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<?php
$model->translate(Yii::$app->language);
?>
<div class="row">
    <div class="col-lg-5">
        <div class="news-block-img">
            <?= Html::a(Html::img($model->getWallpaper()), ['view', 'id' => $model->id]); ?>
        </div>
    </div>

    <div class="col-lg-7">
        <?= Html::a($model->title, ['view', 'id' => $model->id], ['class' => 'news-index-title']); ?>
        <?= Html::a(StringHelper::truncateWords($model->description, 25, $suffix = '...'), ['view', 'id' => $model->id],['class'=>'library-index-desc']); ?>
        <div class="clear tags-cover">
            <div class="tags-block">
                <?= Html::tag('span', Yii::t('app', 'Тэг') . ': ', ['class' => 'tag-heading']); ?>
                <span class="tag-list">
                    <?php
                    $tags = $model->tagList;
                    foreach ($tags as $key => $val) {
                        echo " / " . $val['title'] . "  ";
                    }
                    ?>
            </div>

            <div class="tags-block">
                <?= Html::tag('span', Yii::t('app', 'Категория') . ': ', ['class' => 'tag-heading']); ?>
                <span class="tag-list">
                    <?php
                    $cats = $model->catList;
                    foreach ($cats as $key => $val) {
                        echo " / " . $val['title'] . "  ";
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
                        echo " / " . $val['title'] . "  ";
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>