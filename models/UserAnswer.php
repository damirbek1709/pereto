<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_answers".
 *
 * @property int $id
 * @property int $test_id
 * @property int $question_id
 * @property int $answer_id
 */
class UserAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'question_id', 'answer_id'], 'required'],
            [['test_id', 'question_id', 'answer_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_id' => Yii::t('app', 'Test ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'answer_id' => Yii::t('app', 'Answer ID'),
        ];
    }

    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    } 

    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answer_id']);
    } 

    public function getAns()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answer_id']);
    } 
}
