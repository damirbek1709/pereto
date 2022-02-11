<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "library_bridge".
 *
 * @property int $id
 * @property int $question_id
 * @property int $library_id
 */
class LibraryBridge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library_bridge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'library_id'], 'required'],
            [['question_id', 'library_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'library_id' => Yii::t('app', 'Library ID'),
        ];
    }

    public function getLibary()
    {
        return $this->hasOne(Libraries::className(), ['question_id' => 'id']);
    }
}
