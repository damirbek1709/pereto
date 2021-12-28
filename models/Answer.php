<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property int $question_id
 * @property string $title
 * @property string $title_ky
 * @property string $title_en
 * @property string $assessment_ky
 * @property string $assessment_en
 * @property string $hint
 * @property string $hint_ky
 * @property string $hint_en
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'title', 'title_ky', 'title_en', 'assessment_ky', 'assessment_en','assesment', 'hint', 'hint_ky', 'hint_en'], 'required'],
            [['question_id'], 'integer'],
            [['title', 'title_ky', 'title_en'], 'string', 'max' => 500],
            [['assessment_ky', 'assessment_en','assessment', 'hint', 'hint_ky', 'hint_en'], 'string', 'max' => 1000],
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
            'title' => Yii::t('app', 'Title'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'title_en' => Yii::t('app', 'Title En'),
            'assessment_ky' => Yii::t('app', 'Assessment Ky'),
            'assessment_en' => Yii::t('app', 'Assessment En'),
            'assessment' => Yii::t('app', 'Assessment'),
            'hint' => Yii::t('app', 'Hint'),
            'hint_ky' => Yii::t('app', 'Hint Ky'),
            'hint_en' => Yii::t('app', 'Hint En'),
        ];
    }
}
