<?php

namespace app\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "reports".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string|null $title_en
 * @property string|null $text_en
 * @property string $date
 * @property string|null $photo
 * @property string|null $photo_crop
 * @property string|null $photo_cropped
 * @property string|null $title_ky
 * @property string|null $text_ky
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'date'], 'required'],
            [['text', 'text_en'], 'string'],
            [['date'], 'safe'],
            [['title', 'title_en', 'title_ky', 'text_ky'], 'string', 'max' => 255],
            //[['photo', 'photo_crop', 'photo_cropped'], 'string', 'max' => 100],
            ['photo', 'file', 'extensions' => 'png, jpeg, jpg, gif', 'on' => ['insert', 'update']],
            [['photo_crop', 'photo_cropped'], 'string', 'max' => 100]
        ];
    }

    function behaviors()
    {
        return [
            [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'photo',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/images/reports',
                'url' => '@web/images/reports',
				'ratio' => 3/2,
				'crop_field' => 'photo_crop',
				'cropped_field' => 'photo_cropped',
            ],
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/reports/").$this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/reports/{$this->photo_cropped}";
        } else {
            return Url::base() . "/images/site/template.png";
        }
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
            'title_en' => Yii::t('app', 'Title En'),
            'text_en' => Yii::t('app', 'Text En'),
            'date' => Yii::t('app', 'Date'),
            'photo' => Yii::t('app', 'Photo'),
            'photo_crop' => Yii::t('app', 'Photo Crop'),
            'photo_cropped' => Yii::t('app', 'Photo Cropped'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'text_ky' => Yii::t('app', 'Text Ky'),
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
