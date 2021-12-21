<?php

namespace app\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string|null $title_ky
 * @property string|null $text_ky
 * @property string|null $title_en
 * @property string|null $text_en
 * @property string|null $photo
 * @property string|null $photo_crop
 * @property string|null $photo_cropped
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
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
            [['photo'], 'safe'],
            ['photo', 'file', 'extensions' => 'png, jpeg, jpg, gif', 'on' => ['insert', 'update']],
            [['photo_crop', 'photo_cropped'], 'string', 'max' => 100]
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/partner/").$this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/partner/{$this->photo_cropped}";
        } else {
            return Url::base() . "/images/site/template.png";
        }
    }

    function behaviors()
    {
        return [
            [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'photo',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/images/partner',
                'url' => '@web/images/partner',
                'ratio' => 3 / 2,
                'crop_field' => 'photo_crop',
                'cropped_field' => 'photo_cropped',
            ],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Имя партнера'),
            'text' => Yii::t('app', 'Текст'),
            'title_ky' => Yii::t('app', 'Заголовок на кыргызском'),
            'text_ky' => Yii::t('app', 'Текст на кыргызском'),
            'title_en' => Yii::t('app', 'Заголовок на английском'),
            'text_en' => Yii::t('app', 'Текст на английском'),
            'photo' => Yii::t('app', 'Изображение'),
            'photo_crop' => Yii::t('app', 'Photo Crop'),
            'photo_cropped' => Yii::t('app', 'Photo Cropped'),
        ];
    }
}
