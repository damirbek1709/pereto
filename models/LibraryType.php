<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "library_type".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ky
 * @property string $title_en
 */
class LibraryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library_type';
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

    function translate($language)
    {
        switch ($language) {
            case "en":
                if ($this->title_en != null) {
                    $this->title = $this->{"title_en"};
                } else {
                    $this->title = $this->{"title"};
                }
                break;
            case "ky":
                if ($this->title_ky != null) {
                    $this->title = $this->{"title_ky"};
                } else {
                    $this->title = $this->{"title"};
                }
                break;
            default:
                $this->title = $this->{"title"};
        }
    }
}
