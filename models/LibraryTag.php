<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "library_tag".
 *
 * @property int $id
 * @property string $title
 * @property string|null $title_ky
 * @property string|null $title_en
 */
class LibraryTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
