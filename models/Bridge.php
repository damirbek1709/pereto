<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bridge".
 *
 * @property int $post_id
 * @property int|null $tag_id
 * @property int|null $category_id
 * @property int|null $type_id
 */
class Bridge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bridge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id', 'tag_id', 'category_id', 'type_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'type_id' => Yii::t('app', 'Type ID'),
        ];
    }
}
