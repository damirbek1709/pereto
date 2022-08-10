<?php

namespace app\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;

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
    public $file;
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
            [['title', 'description', 'text', 'date'], 'required'],
            [['text', 'text_ky', 'text_en'], 'string'],
            [['description', 'description_en', 'description_ky'], 'string', 'max' => 500],
            [['title', 'title_ky', 'title_en'], 'string', 'max' => 255],
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
                'ratio' => 3 / 2,
                'crop_field' => 'photo_crop',
                'cropped_field' => 'photo_cropped',
            ],
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/news/") . $this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/news/{$this->photo_cropped}";
        } else {
            return Url::base() . "/images/site/template.png";
        }
    }

    public function getOtherNews()
    {
        return self::find()->where(['<>', 'id', $this->id])->limit(8)->orderBy(['date'=>SORT_DESC])->all();
    }

    function beforeValidate()
    {
        $this->file = UploadedFile::getInstances($this, 'file');
        return parent::beforeValidate();
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->file) {
            $dir = Yii::getAlias("@webroot/images/news/{$this->id}");
            $thumbDir = Yii::getAlias("@webroot/images/news/{$this->id}/thumbs");
            FileHelper::createDirectory($dir);
            FileHelper::createDirectory($thumbDir);
            $imagine = Image::getImagine();
            $now = time();
            $counter = 1;
            foreach ($this->file as $file) {
                $filename = $file->name;
                $file->saveAs("{$dir}" . DIRECTORY_SEPARATOR . "{$filename}");


                $img = Image::getImagine()->open(
                    Yii::getAlias('@webroot/images/news')
                        . "/{$this->id}/{$filename}",
                    ['quality' => 100]
                );

                $size = $img->getSize();
                $ratio = $size->getWidth() / $size->getHeight();

                $width = 600;
                $height = round($width / $ratio);
                $box = new Box($width, $height);
                $img->resize($box)->save($dir . '/' . "{$filename}", ['quality' => 100]);


                $thumbWidth = 145;
                $thumbHeight = round($thumbWidth / $ratio);
                $thumbBox = new Box($thumbWidth, $thumbHeight);
                $img->resize($thumbBox)->save($dir . '/thumbs/' . "{$filename}", ['quality' => 100]);

                $counter++;
            }
        }
    }

    function getThumbImages()
    {
        $result = [];
        if (is_dir(Yii::getAlias("@webroot/images/news/{$this->id}")) && !$this->isNewRecord) {
            $images = FileHelper::findFiles(Yii::getAlias("@webroot/images/news/{$this->id}/thumbs"), [
                'recursive' => false,
                'except' => ['.gitignore']
            ]);

            $index = 0;
            foreach ($images as $image) {
                $result[] = Html::img(str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $image));

                $index++;
            }
            return $result;
        }
    }

    function getThumbs()
    {
        $result = [];
        if (is_dir(Yii::getAlias("@webroot/images/news/{$this->id}"))) {
            $images = FileHelper::findFiles(Yii::getAlias("@webroot/images/news/{$this->id}/thumbs"), [
                'recursive' => false,
                'except' => ['.gitignore']
            ]);

            $index = 0;
            foreach ($images as $image) {
                $result[] = $image;
                $index++;
            }
        }
        return $result;
    }

    function getImages()
    {
        if (is_dir(Yii::getAlias("@webroot/images/news/{$this->id}"))) {
            $images = FileHelper::findFiles(Yii::getAlias("@webroot/images/news/{$this->id}"), [
                'recursive' => false,
                'except' => ['.gitignore'],
            ]);
            $thumbs = FileHelper::findFiles(Yii::getAlias("@webroot/images/news/{$this->id}/thumbs"), [
                'recursive' => false,
                'except' => ['.gitignore'],
            ]);
            $result = [];
            $thumbResult = [];

            foreach ($images as $image) {
                $result[] = str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $image);                
            }

            foreach ($thumbs as $thumb) {
                $thumbResult[] = str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $thumb);                
            }
            $result = array_combine($thumbResult, $result);
        } else {
            $result = [];
        }
        return $result;
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
            'title_ky' => Yii::t('app', 'Title Ky'),
            'text_ky' => Yii::t('app', 'Text Ky'),
            'description' => Yii::t('app', 'Description'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_ky' => Yii::t('app', 'Description Ky'),
            'text' => Yii::t('app', 'Text'),
            'text_en' => Yii::t('app', 'Text En'),
            'date' => Yii::t('app', 'Date'),
            'photo' => 'Изображение',
            'file' => 'Фото',
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
