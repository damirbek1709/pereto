<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index" data-show="<?=Yii::t('app','Показать все')?>" data-hide="<?=Yii::t('app','Скрыть')?>">
<h1 class="main-heading"><?= Html::encode($this->title) ?></h1>
    <?php echo ListView::widget([
        'options' => [
            'class' => 'partner-list',
        ],
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summary' => false,
        'itemOptions' => [
            'class' => 'partner-index-block col-lg-12',
        ],
    ]); ?>
</div>

<script type="text/javascript">
    $(".show-more").click(function() {
        if ($(this).siblings(".text").hasClass("show-more-height")) {
            var text = $('.partner-index').attr('data-hide');
            $(this).text(text);
        } else {
            var text = $('.partner-index').attr('data-show');
            $(this).text(text);
        }

        $(this).siblings(".text").toggleClass("show-more-height");
    });
</script>
