<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "consumer".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string|null $title_ky
 * @property string|null $text_ky
 * @property string|null $title_en
 * @property string|null $text_en
 */
class App extends \yii\db\ActiveRecord
{
    public static function getLanguageLabel(){
        switch(Yii::$app->language){
            case 'ru': return 'Рус';break;
            case 'en': return 'En';break;
            case 'ky': return 'Кыр';break;
            default: return 'Рус';
        }
    }
}
