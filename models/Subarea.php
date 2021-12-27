<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subarea".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $title_ky
 * @property string $text_en
 */
class Subarea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subarea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'title_ky', 'text_en'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'title_ky', 'text_en'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title' => Yii::t('app', 'Title'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'text_en' => Yii::t('app', 'Text En'),
        ];
    }
}
