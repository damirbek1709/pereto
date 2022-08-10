<?php

use app\models\App;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LibrariesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$h1_title = Yii::t('app', 'Libraries');
$this->params['breadcrumbs'][] = Yii::t('app', 'Businesses');
$this->params['breadcrumbs'][] = $h1_title;
?>
<div class="libraries-index">
    <h1 class="new-heading"><?= Html::encode($h1_title) ?></h1>
    <p class="library-description">
        <?php echo App::getLibraryString(); ?>
    </p>
    <?= Html::beginForm(['libraries/index'], 'get') ?>


    <div class="row">
        <div class="col-lg-4">
            <div class="search-block">
                <div class="form-group rel">
                    <div class="input-group mb-3">
                        <?= Html::input('text', "", '', [
                            'class' => 'form-control search_input',
                            'minlength' => 3,
                            'placeholder' => Yii::t('app', 'Поиск'),
                            'aria-label' => '',
                            'aria-describedby' => 'search-addon',
                        ]);
                        ?>
                        <div class="input-group-append">
                            <span class="input-group-text" id="search-addon">
                                <?= Html::button("<i class='fas fa-search'></i>", ['class' => 'search-btn', 'type' => 'submit']) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->render('filter-collapse', [
                'type' => $type,
                'tag' => $tag,
                'category' => $category
            ]); ?>
        </div>
        <div class="col-lg-8">
            <?php echo ListView::widget([
                'options' => [
                    'class' => 'program-list flex-custom',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'summary' => false,
                'itemOptions' => [
                    'class' => 'news-index-block',
                ],
            ]); ?>
        </div>
    </div>
    <?= Html::endForm() ?>

</div>