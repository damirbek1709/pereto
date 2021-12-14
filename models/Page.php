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
            'title' => Yii::t('app', 'Заголовок'),
            'title_ky' => Yii::t('app', 'Заголовок на кыргызском'),
            'title_en' => Yii::t('app', 'Заголовок на английском'),
            'text' => Yii::t('app', 'Текст'),
            'text_ky' => Yii::t('app', 'Текст на кыргызском'),
            'text_en' => Yii::t('app', 'Текст на английском'),
            'photo' => Yii::t('app', 'Изображение'),
            'description' => Yii::t('app', 'Описание'),
            'description_ky' => Yii::t('app', 'Описание на кыргызском'),
            'description_en' => Yii::t('app', 'Описание на английском'),
        ];
    }
}
