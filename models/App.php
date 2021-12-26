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

    public static function getLibraryString(){
        $language = Yii::$app->language;
        $ru_string = 'Библиотека ПЭРЭТО — это собрание передовых практик, применяемых малыми и средними предприятиями ХоРеКа в Кыргызстане и в мире. Он демонстрирует разнообразие возможных решений и практик, которые приводят к экономии ресурсов, экономической эффективности и получению зеленого имиджа среди клиентов.
        В библиотеке предоставлены модели мер по экономии энергии и воды, предотвращению отходов в отелях, ресторанах и кафе. Кроме того, некоторые модели могут быть применимы в других коммерческих секторах, кроме ХоРеКа, а также в жилых домах.        
        Библиотека предлагает панель поиска и фильтры по типу, категории и тегам для удобства. Обратите внимание, что в ближайшие годы библиотека будет расширяться, и будут добавляться новые передовые практики. Если вы хотите включить свою зеленую практику в библиотеку ПЭРЭТО или предложить другую, то пожалуйста, свяжитесь с командой ПЭРЭТО по адресу pereto@auca.kg.';
        
        $kg_string = 'ПЭРЭТО китепканасы - бул Кыргызстандагы жана дүйнөдөгү HoReCa чакан жана орто ишканалары колдонгон алдыңкы практикалардын   жыйындысы. Ал ресурстарды үнөмдөөгө, экономикалык натыйжалуулукка жана кардарлар арасында жашыл имиджге алып келүүчү ар кандай мүмкүн болгон чечимдерди жана тажрыйбаларды көрсөтөт. Китепканада электр кубатын  жана сууну үнөмдөө, мейманканаларда, ресторандарда жана кафелерде калдыктардын алдын алуу  боюнча  чаралардын моделдери келтирилген. Мындан тышкары, кээ бир моделдер HoReCaдан башка коммерциялык секторлордо, ошондой эле турак үйлөрдө колдонулушу мүмкүн. 
        Китепкана ыңгайлуулук үчүн түрү, категориясы, тегдери боюнча издөө панелин жана  чыпкаларды сунуш кылат. .  Жакынкы жылдары китепкана кеңейип, жаңы алдыңкы практикалар  кошуларына көңүл буруңуздар.. Эгерде сиз өзүңүздүн жашыл практикаңызды ПЭРЭТО китепканасына киргизүүнү же башка нерсени сунуштоону кааласаңыз, анда pereto@auca.kg дареги боюнча ПЭРЭТО командасына кайрылыңыз.';

        $en_string = 'PERETO library is a collection of good practices implemented by HoReCa SMEs in Kyrgyzstan and around the world. It demonstrates diversity of possible solutions and practices that lead to saving resources, cost efficiency and gaining of green image among customers. 
        There are examples of measures saving energy and water, avoiding waste at hotels, restaurants and cafes. Additionally, some examples could be applicable in other commercial sectors other than HoReCa and also residential homes.        
        Library offers search bar and filters by type, category and tags for convenience. Please note that library will be expanding over the coming years, and new good practices will be added. If you would like to feature your green practice as HoReCa SME or suggest one, please contact PERETO team at pereto@auca.kg';

        switch($language){
            case 'ru': return $ru_string;
            break;
            case 'ky': return $kg_string;
            break;
            case 'en': return $en_string;
            break;
            default: return $ru_string;
        }
    }

    public static function getLibraryTitle(){
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
        return $title;
    }
}
