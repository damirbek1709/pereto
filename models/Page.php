<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\web\UploadedFile;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string|null $title_ky
 * @property string|null $title_en
 * @property string $text
 * @property string|null $text_ky
 * @property string|null $text_en
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text_ky', 'text_en'], 'safe'],
            [['title', 'title_ky', 'title_en'], 'string', 'max' => 255],
            [['description', 'description_ky', 'description_en'], 'string', 'max' => 1000],
            //[['photo'], 'safe'],
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
                'path' => '@webroot/images/page',
                'url' => '@web/images/page',
				'ratio' => 3/2,
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
                    $this->description = $this->{"description_en"};
                } else {
                    $this->title = $this->{"title"};
                    $this->text = $this->{"text"};
                    $this->description = $this->{"description"};
                }
                break;
            case "ky":
                if ($this->title_ky != null) {
                    $this->title = $this->{"title_ky"};
                    $this->text = $this->{"text_ky"};
                    $this->description = $this->{"description_ky"};
                } else {
                    $this->title = $this->{"title"};
                    $this->text = $this->{"text"};
                    $this->description = $this->{"description"};
                }
                break;
            default:
                $this->title = $this->{"title"};
                $this->text = $this->{"text"};
                $this->description = $this->{"description"};
        }
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/page/").$this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/page/{$this->photo_cropped}";
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
            'title_ky' => Yii::t('app', 'Title Ky'),
            'title_en' => Yii::t('app', 'Title En'),
            'text' => Yii::t('app', 'Text'),
            'text_ky' => Yii::t('app', 'Text Ky'),
            'text_en' => Yii::t('app', 'Text En'),
            'photo' => Yii::t('app', 'Photo'),
            'description' => Yii::t('app', 'Description'),
            'description_ky' => Yii::t('app', 'Description Ky'),
            'description_en' => Yii::t('app', 'Description En'),
        ];
    }
}
