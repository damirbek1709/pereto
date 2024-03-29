<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_test".
 *
 * @property int $id
 * @property string $email
 * @property string $organization_name
 * @property int $buisness_type
 * @property string $date
 */
class UserTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'organization_name', 'buisness_type'], 'required'],
            [['buisness_type'], 'integer'],
            [['email'], 'email'],
            [['date'], 'safe'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['email', 'organization_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'E-mail'),
            'organization_name' => Yii::t('app', 'Organization Name'),
            'buisness_type' => Yii::t('app', 'Business Type'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    public function getAnswers()
    {
        return $this->hasMany(UserAnswer::className(), ['test_id' => 'id']);
    }

    public function getBusinessType()
    {
        return $this->hasOne(BusinessType::className(), ['id' => 'buisness_type']);
    }
}
