<?php

namespace app\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "library".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string|null $title_ky
 * @property string|null $description_ky
 * @property string|null $text_ky
 * @property string|null $title_en
 * @property string|null $text_en
 * @property string|null $description_en
 * @property string|null $photo
 * @property string|null $photo_crop
 * @property string|null $photo_cropped
 */
class Libraries extends \yii\db\ActiveRecord
{
    public $category_id;
    public $tag_id;
    public $type_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text'], 'required'],
            [['text', 'text_ky', 'text_en'], 'string'],
            [['title', 'title_ky', 'title_en'], 'string', 'max' => 255],
            [['description', 'description_ky', 'description_en'], 'string', 'max' => 500],
            ['photo', 'file', 'extensions' => 'png, jpeg, jpg, gif', 'on' => ['insert', 'update']],
			[['photo_crop', 'photo_cropped'], 'string', 'max' => 100]
            //[['category_id', 'tag_id', 'type_id'], 'string', 'max' => 100],
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
            'description' => Yii::t('app', 'Description'),
            'text' => Yii::t('app', 'Text'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'description_ky' => Yii::t('app', 'Description Ky'),
            'text_ky' => Yii::t('app', 'Text Ky'),
            'title_en' => Yii::t('app', 'Title En'),
            'text_en' => Yii::t('app', 'Text En'),
            'description_en' => Yii::t('app', 'Description En'),
            'photo' => Yii::t('app', 'Photo'),
            'photo_crop' => Yii::t('app', 'Photo Crop'),
            'photo_cropped' => Yii::t('app', 'Photo Cropped'),
            'category_id' => Yii::t('app', 'Категория'),
            'type_id' => Yii::t('app', 'Тип'),
            'tag_id' => Yii::t('app', 'Тэг'),
        ];
    }

    function behaviors()
    {
        return [
            [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'photo',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/images/library',
                'url' => '@web/images/library',
				'ratio' => 3/2,
				'crop_field' => 'photo_crop',
				'cropped_field' => 'photo_cropped',
            ],
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/library/").$this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/library/{$this->photo_cropped}";
        } else {
            return Url::base() . "/images/site/template.png";
        }
    }
}