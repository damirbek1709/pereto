<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $url
 * @property string $meta_title
 * @property string $meta_description
 * @property string $text
 * @property string $meta_title_ky
 * @property string $meta_description_ky
 * @property string $text_ky
 * @property string $meta_title_en
 * @property string $meta_description_en
 * @property string $text_en
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'meta_title', 'meta_description'], 'required'],
            [['text', 'text_ky', 'text_en'], 'string'],
            [['url', 'meta_title', 'meta_description', 'meta_title_ky', 'meta_description_ky', 'meta_title_en', 'meta_description_en'], 'string', 'max' => 255],
            [['meta_keywords', 'meta_keywords_ky', 'meta_keywords_en'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'text' => Yii::t('app', 'Text'),
            'meta_title_ky' => Yii::t('app', 'Meta Title Ky'),
            'meta_description_ky' => Yii::t('app', 'Meta Description Ky'),
            'text_ky' => Yii::t('app', 'Text Ky'),
            'meta_title_en' => Yii::t('app', 'Meta Title En'),
            'meta_description_en' => Yii::t('app', 'Meta Description En'),
            'text_en' => Yii::t('app', 'Text En'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_keywords_en' => Yii::t('app', 'Meta Keywords En'),
            'meta_keywords_ky' => Yii::t('app', 'Meta Keywords Ky'),
        ];
    }

    function translate($language)
    {
        switch ($language) {
            case "en":
                if ($this->meta_title_en != null) {
                    $this->meta_title = $this->{"meta_title_en"};
                    $this->meta_description = $this->{"meta_description_en"};
                    $this->meta_keywords = $this->{"meta_keywords_en"};
                } else {
                    $this->meta_title = $this->{"meta_title"};
                    $this->meta_description = $this->{"meta_description"};
                    $this->meta_keywords = $this->{"meta_keywords"};
                }
                break;
            case "ky":
                if ($this->meta_title_ky != null) {
                    $this->meta_title = $this->{"meta_title_ky"};
                    $this->meta_description = $this->{"meta_description_ky"};
                    $this->meta_keywords = $this->{"meta_keywords_ky"};
                } else {
                    $this->meta_title = $this->{"meta_title"};
                    $this->meta_description = $this->{"meta_description"};
                    $this->meta_keywords = $this->{"meta_keywords"};
                }
                break;
            default:
                $this->meta_title = $this->{"meta_title"};
                $this->meta_description = $this->{"meta_description"};
                $this->meta_keywords = $this->{"meta_keywords"};
        }
    }
}
