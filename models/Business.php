<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $title_ky
 * @property string $text_ky
 * @property string $title_en
 * @property string $text_en
 */
class Business extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text', 'text_ky', 'text_en'], 'string'],
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
            'text' => Yii::t('app', 'Text'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'text_ky' => Yii::t('app', 'Text Ky'),
            'title_en' => Yii::t('app', 'Title En'),
            'text_en' => Yii::t('app', 'Text En'),
        ];
    }

    function translate($language)
    {
        switch ($language) {
            case "en":
                if ($this->title_en != null) {
                    $this->title = $this->{"title_en"};
                    $this->text = $this->{"text_en"};
                } else {
                    $this->title = $this->{"title"};
                    $this->text = $this->{"text"};
                }
                break;
            case "ky":
                if ($this->title_ky != null) {
                    $this->title = $this->{"title_ky"};
                    $this->text = $this->{"text_ky"};
                } else {
                    $this->title = $this->{"title"};
                    $this->text = $this->{"text"};
                }
                break;
            default:
                $this->title = $this->{"title"};
                $this->text = $this->{"text"};
        }
    }
}
