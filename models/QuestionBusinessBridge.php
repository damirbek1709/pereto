<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_business_bridge".
 *
 * @property int $id
 * @property int $question_id
 * @property int $business_type_id
 */
class QuestionBusinessBridge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_business_bridge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'business_type_id'], 'required'],
            [['question_id', 'business_type_id'], 'integer'],
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
            'business_type_id' => Yii::t('app', 'Business Type ID'),
        ];
    }
}
