<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer_library_bridge".
 *
 * @property int $answer_id
 * @property int $library_id
 */
class Ans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer_library_bridge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer_id', 'library_id'], 'required'],
            [['answer_id', 'library_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'answer_id' => Yii::t('app', 'Answer ID'),
            'library_id' => Yii::t('app', 'Library ID'),
        ];
    }
}
