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
            [['email', 'organization_name', 'buisness_type', 'date'], 'required'],
            [['buisness_type'], 'integer'],
            [['date'], 'safe'],
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
            'email' => Yii::t('app', 'Email'),
            'organization_name' => Yii::t('app', 'Organization Name'),
            'buisness_type' => Yii::t('app', 'Buisness Type'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
