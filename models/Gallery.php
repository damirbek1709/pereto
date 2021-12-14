<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;


/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ky
 * @property string $title_en
 */
class Gallery extends \yii\db\ActiveRecord
{

    public $files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'title_ky', 'title_en','main_img'], 'string', 'max' => 255],
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
            'title_ky' => Yii::t('app', 'Title Ky'),
            'title_en' => Yii::t('app', 'Title En'),
            'files' => Yii::t('app', 'Файлы'),
            'main_img' => Yii::t('app', 'Основной рисунок'),
        ];
    }

    function getThumbImages()
    {
        $result = [];
        if (is_dir(Yii::getAlias("@webroot/images/gallery/{$this->id}")) && !$this->isNewRecord) {
            $images = FileHelper::findFiles(Yii::getAlias("@webroot/images/gallery/{$this->id}/thumbs"), [
                'recursive' => false,
                'except' => ['.gitignore']
            ]);

            $index = 0;
            foreach ($images as $image) {
                $result[] = Html::img(str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $image));
                if (basename($image) == $this->main_img) {
                    $new_value = Html::img(str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $image));
                    unset($result[$index]);
                    array_unshift($result, $new_value);
                }
                $index++;
            }
        }
        return $result;

    }


    function getThumbs()
    {
        $result = [];
        if (is_dir(Yii::getAlias("@webroot/images/gallery/{$this->id}"))) {
            $images = FileHelper::findFiles(Yii::getAlias("@webroot/images/gallery/{$this->id}/thumbs"), [
                'recursive' => false,
                'except' => ['.gitignore']
            ]);
            foreach ($images as $image) {
                $result[] = basename($image);
            }

        }
        return $result;
    }

    function getImages()
    {
        if (is_dir(Yii::getAlias("@webroot/images/gallery/{$this->id}"))) {
            $images = FileHelper::findFiles(Yii::getAlias("@webroot/images/gallery/{$this->id}"), [
                'recursive' => false,
                'except' => ['.gitignore'],
            ]);
            $thumbs = FileHelper::findFiles(Yii::getAlias("@webroot/images/gallery/{$this->id}/thumbs"), [
                'recursive' => false,
                'except' => ['.gitignore'],
            ]);
            $result = [];
            $thumbResult = [];

            foreach ($images as $image) {
                $result[] = str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $image);
                if (basename($image) == $this->main_img) {
                    $new_value = $image;
                    unset($image);
                    array_unshift($result, str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $new_value));
                }
            }

            foreach ($thumbs as $thumb) {
                $thumbResult[] = str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $thumb);
                if (basename($thumb) == $this->main_img) {
                    if (basename($thumb) == $this->main_img) {
                        $new_value = $thumb;
                        unset($thumb);
                        array_unshift($thumbResult, str_replace([Yii::getAlias('@webroot'), DIRECTORY_SEPARATOR], [Yii::getAlias('@web'), '/'], $new_value));
                    }
                }
            }
            if (count($result) == count($thumbResult)) {
                $result = array_combine($thumbResult, $result);
            }


        } else {
            $result = [Url::base() . "/images/category/template.png" => Url::base() . "/images/category/template.png"];
        }
        return $result;
    }

    public function beforeValidate()
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (count($this->files)) {
            $dir = Yii::getAlias("@webroot/images/gallery/{$this->id}/");
            $thumbDir = Yii::getAlias("@webroot/images/gallery/{$this->id}/thumbs");
            FileHelper::createDirectory($dir);
            FileHelper::createDirectory($thumbDir);
            $imagine = Image::getImagine();
            $counter = 1;
            $ts = time();
            foreach ($this->files as $file) {
                $filename = $counter . $ts . "." . $file->extension;
                $file->saveAs("{$dir}/{$filename}");
                $image = $imagine->open($dir . "/" . $filename);
                $image->thumbnail(new Box(800, 600))->save($dir . "/" . $filename);
                $image->thumbnail(new Box(400, 300))
                    /*->crop(new Point(50, 25), new Box(320, 275))*/
                    ->save("{$thumbDir}/{$filename}", ['quality' => 100]);
                $counter++;
            }
        }
    }
}
