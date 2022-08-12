<?php

use app\models\UserAnswer;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserTest */

$this->title = $model->organization_name."-".$model->email."(".$model->businessType->title.")";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-test-view">

    <h1 class="main-heading"><?=$this->title;?></h1>

    
    <?php $answers = $model->answers;
    $counter = 1;
        foreach($answers as $item){
            echo Html::beginTag('div',['class'=>'ans-quest-block']);           
            echo Html::tag('div',$counter.". ".$item->question->title,['class'=>'user-quest']);
            echo Html::tag('div',$item->ans->title,['class'=>'user-ans']);
            echo Html::endTag('div');
            $counter++;
        }
    ?>

</div>
