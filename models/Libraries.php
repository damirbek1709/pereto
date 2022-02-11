<?php

namespace app\models;

use Yii;
use karpoff\icrop\CropImageUploadBehavior;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library';
    }

    public static function getTypeParamList()
    {
        $title = 'title';
        switch (Yii::$app->language) {
            case 'ky':
                $title = 'title_ky';
                break;
            case 'en':
                $title = 'title_en';
                break;
            default:
                $title = 'title';
        }
        return ArrayHelper::map(LibraryType::find()->all(), 'id', $title);
    }

    public static function getCategoryParamList()
    {
        $title = 'title';
        switch (Yii::$app->language) {
            case 'ky':
                $title = 'title_ky';
                break;
            case 'en':
                $title = 'title_en';
                break;
            default:
                $title = 'title';
        }
        return ArrayHelper::map(LibraryCategory::find()->all(), 'id', $title);
    }

    public static function getTagParamList()
    {
        $title = 'title';
        switch (Yii::$app->language) {
            case 'ky':
                $title = 'title_ky';
                break;
            case 'en':
                $title = 'title_en';
                break;
            default:
                $title = 'title';
        }
        return ArrayHelper::map(LibraryTag::find()->all(), 'id', $title);
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
            [['photo_crop', 'photo_cropped'], 'string', 'max' => 100],
            [['photo'], 'safe'],
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
                'ratio' => 3 / 2,
                'crop_field' => 'photo_crop',
                'cropped_field' => 'photo_cropped',
            ],
        ];
    }

    public function getWallpaper()
    {
        $filename = Yii::getAlias("@webroot/images/library/") . $this->photo;
        if (file_exists($filename)) {
            return Url::base() . "/images/library/{$this->photo_cropped}";
        } else {
            return Url::base() . "/images/site/template.png";
        }
    }

    public function getTagList()
    {
        $title = 'title';
        switch (Yii::$app->language) {
            case 'ky':
                $title = 'title_ky';
                break;
            case 'en':
                $title = 'title_en';
                break;
            default:
                $title = 'title';
        }
        $rows = (new \yii\db\Query())
            ->select(['id', $title])
            ->from('bridge')
            ->where(['post_id' => $this->id])
            ->andWhere(['not', ['tag_id' => null]])
            ->leftJoin('library_tag', 'library_tag.id = bridge.tag_id')
            ->all();
        return $rows;
    }

    public function getCatList()
    {
        $title = 'title';
        switch (Yii::$app->language) {
            case 'ky':
                $title = 'title_ky';
                break;
            case 'en':
                $title = 'title_en';
                break;
            default:
                $title = 'title';
        }
        $rows = (new \yii\db\Query())
            ->select(['id', $title])
            ->from('bridge')
            ->where(['post_id' => $this->id])
            ->andWhere(['not', ['category_id' => null]])
            ->leftJoin('library_category', 'library_category.id = bridge.category_id')
            ->all();
        return $rows;
    }

    public function getTypeList()
    {
        $title = 'title';
        switch (Yii::$app->language) {
            case 'ky':
                $title = 'title_ky';
                break;
            case 'en':
                $title = 'title_en';
                break;
            default:
                $title = 'title';
        }
        $rows = (new \yii\db\Query())
            ->select(['id', $title])
            ->from('bridge')
            ->where(['post_id' => $this->id])
            ->andWhere(['not', ['type_id' => null]])
            ->leftJoin('library_type', 'library_type.id = bridge.type_id')
            ->all();
        return $rows;
    }

    public function getBridge()
    {
        return $this->hasMany(Bridge::className(), ['post_id' => 'id']);
    }

    public function getMost()
    {
        return $this->hasOne(LibraryBridge::className(), ['library_id' => 'id']);
    }

    public function getCategoryTags()
    {
        return ArrayHelper::map(Bridge::find()->where(['post_id' => $this->id])->andWhere(['not', ['category_id' => null]])->all(), 'category_id', 'category_id');
    }

    public function getTypeTags()
    {
        return ArrayHelper::map(Bridge::find()->where(['post_id' => $this->id])->andWhere(['not', ['type_id' => null]])->all(), 'type_id', 'type_id');
    }

    public function getDropTags()
    {
        return ArrayHelper::map(Bridge::find()->where(['post_id' => $this->id])->andWhere(['not', ['tag_id' => null]])->all(), 'tag_id', 'tag_id');
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
