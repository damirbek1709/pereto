<?php

use yii\helpers\Html;
use app\models\Libraries;

$type_list = Libraries::getTypeParamList();
$cat_list = Libraries::getCategoryParamList();
$tag_list = Libraries::getTagParamList();
?>
<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <span class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?= Yii::t('app', 'Тип'); ?>
                </span>
            </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <?php
                foreach ($type_list as $key => $val) {
                    $type_checked = false;
                    if ($type && in_array($key, $type)) {
                        $type_checked = "checked";
                    }
                    echo Html::label(Html::checkbox('type[]', $key, ['class' => 'search-class', 'value' => $key, 'checked' => $type_checked, 'onchange' => 'this.form.submit()']) . ' ' . $val, null, ['class' => 'inline checkbox lib-ch-label']);
                }
                ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <span class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <?= Yii::t('app', 'Категория'); ?>
                </span>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <?php
                foreach ($cat_list as $key => $val) {
                    $category_checked = false;
                    if ($category && in_array($key, $category)) {
                        $category_checked = "checked";
                    }
                    echo Html::label(Html::checkbox('category[]', $key, ['class' => 'search-class', 'value' => $key, 'checked' => $category_checked, 'onchange' => 'this.form.submit()']) . ' ' . $val, null, ['class' => 'inline checkbox lib-ch-label']);
                }
                ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <span class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <?= Yii::t('app', 'Тэг'); ?>
                </span>
            </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                <?php
                foreach ($tag_list as $key => $val) {
                    $tag_checked = false;
                    if ($tag && in_array($key, $tag)) {
                        $tag_checked = "checked";
                    }
                    echo Html::label(Html::checkbox('tag[]', $key, ['class' => 'search-class', 'value' => $key, 'checked' => $tag_checked, 'onchange' => 'this.form.submit()']) . ' ' . $val, null, ['class' => 'inline checkbox lib-ch-label']);
                }
                ?>
            </div>
        </div>
    </div>
</div>