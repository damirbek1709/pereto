<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "library_category".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ky
 * @property string $title_en
 */
class LibraryCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_ky', 'title_en'], 'required'],
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
            'title' => Yii::t('app', 'Title'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'title_en' => Yii::t('app', 'Title En'),
        ];
    }
}
