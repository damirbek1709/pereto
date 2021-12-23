<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use karpoff\icrop\CropImageUploadBehavior;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $photo
 * @property string $photo_crop
 * @property string $link
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo'], 'required'],
            [['photo', 'photo_crop', 'link'], 'safe'],
            [['link'], 'string', 'max' => 200],            
            ['photo', 'file', 'extensions' => 'png, jpeg, jpg, gif', 'on' => ['insert', 'update']],
			[['photo_crop', 'photo_cropped'], 'string', 'max' => 100]
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/slider/").$this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/slider/{$this->photo_cropped}";
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
                'path' => '@webroot/images/slider',
                'url' => '@web/images/slider',
				'ratio' => 224/77,
				'crop_field' => 'photo_crop',
				'cropped_field' => 'photo_cropped',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo' => Yii::t('app', 'Photo'),
            'photo_crop' => Yii::t('app', 'Photo Crop'),
            'link' => Yii::t('app', 'Link'),
        ];
    }
}
