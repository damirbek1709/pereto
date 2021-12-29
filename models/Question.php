<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int $category_id
 * @property int $subarea_id
 * @property string $title
 * @property string $title_ky
 * @property string $title_en
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'subarea_id', 'title', 'title_ky', 'title_en'], 'required'],
            [['category_id', 'subarea_id'], 'integer'],
            [['title', 'title_ky', 'title_en'], 'string', 'max' => 255],
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
            'subarea_id' => Yii::t('app', 'Subarea ID'),
            'title' => Yii::t('app', 'Title'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'title_en' => Yii::t('app', 'Title En'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(LibraryCategory::className(), ['id' => 'category_id']);
    }

    public function getBridge()
    {
        return $this->hasOne(QuestionBusinessBridge::className(), ['question_id' => 'id']);
    }
}
