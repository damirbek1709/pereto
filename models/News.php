<?php

namespace app\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $title
 * @property string $description
 * @property string $text
 * @property string $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text'], 'required'],           
            [['date'], 'safe'],
            [['text','text_ky','text_en'], 'string'],
            [['description','description_en','description_ky'], 'string', 'max' => 500],
            [['title','title_ky','title_en'], 'string', 'max' => 255],
            [['photo'], 'safe'],
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
                'path' => '@webroot/images/news',
                'url' => '@web/images/news',
				'ratio' => 3/2,
				'crop_field' => 'photo_crop',
				'cropped_field' => 'photo_cropped',
            ],
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/news/").$this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/news/{$this->photo_cropped}";
        } else {
            return Url::base() . "/images/site/template.png";
        }
    }

    public function getOtherNews(){
        return self::find()->where(['<>','id', $this->id])->all();
    }
   

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'title_en' => Yii::t('app', 'Title En'),
            'description' => Yii::t('app', 'Description'),
            'description_en' => Yii::t('app', 'Description En'),
            'text' => Yii::t('app', 'Text'),
            'text_en' => Yii::t('app', 'Text En'),
            'date' => Yii::t('app', 'Date'),
            'photo'=>'Изображение',
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
}
