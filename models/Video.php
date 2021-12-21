<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string $title
 * @property string $source
 * @property string|null $title_ky
 * @property string|null $title_en
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'source'], 'required'],
            [['title', 'title_ky', 'title_en'], 'string', 'max' => 255],
            [['source'], 'string', 'max' => 1000],
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
            'source' => Yii::t('app', 'Embed code'),
            'title_ky' => Yii::t('app', 'Title Ky'),
            'title_en' => Yii::t('app', 'Title En'),
        ];
    }

    public function getMainThumb()
    {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $this->source, $match);
        $url =  $match[0][0];
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
        $video_id = $matches[1];
        return Html::img("https://i.ytimg.com/vi/{$video_id}/hqdefault.jpg");
    }

    function parse_yturl()
    {
        preg_match('/embed/(.{11})', $this->source, $matches);
        return $matches[1];
    }
}
