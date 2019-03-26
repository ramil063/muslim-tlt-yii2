<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "news".
 *
 * @property string $id
 * @property integer $main_image
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $slug
 * @property integer $can_edit
 * @property integer $on_slider
 * @property string $views_count
 * @property string $user_id
 * @property string $module
 * @property string $author
 * @property string $created_at
 * @property string $updated_at
 * @property integer $on_main
 *
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = [];
        $behaviors[] = [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'user_id',
            'updatedByAttribute' => 'user_id'
        ];
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'value' => function (){
                return date('Y-m-d H:i:s');
            }
        ];
        $schema = 'http';
        if (!(Yii::$app instanceof \Yii\console\application)){
            $schema = Yii::$app->request->getIsSecureConnection() ? 'https' : 'http';
        }
        $behaviors[] = [
            'class' => '\modules\core\components\behaviors\ImageUploadBehavior',
            'attribute' => 'main_image',
            'filePath' => Yii::$app->params['uploadDir'].'/news/[[pk]]/images/[[basename]]',
            'fileUrl' => Url::to('//'.Yii::$app->params['rootDomain'].'/upload/news/[[pk]]/images/[[basename]]', $schema),
            'thumbPath' => Yii::$app->params['uploadDir'].'/news/[[pk]]/images/[[profile]]/[[basename]]',
            'thumbUrl' => Url::to('//'.Yii::$app->params['rootDomain'].'/upload/news/[[pk]]/images/[[profile]]/[[basename]]', $schema),
            'thumbs' => [
                'mini' => ['width' => 300, 'height' => 220],
                'medium' => ['width' => 1000, 'height' => 450],
            ],
        ];
        $behaviors[] = [
            'class' => 'Zelenin\yii\behaviors\Slug',
            'attribute' => 'title',
            'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
        ];
        $behaviors[] = [
            'class' => '\modules\core\components\behaviors\RelationBehavior',
            'entity' => [
                Album::class => Yii::$app->request->post('Albums'),
            ]
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'title', 'description'], 'required'],
            [['can_edit', 'on_slider', 'views_count', 'user_id', 'on_main', 'news_status_id'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['description', 'author'], 'string', 'max' => 500],
            [['module'], 'string', 'max' => 250],
            [['main_image'], 'image', 'extensions' => 'jpg, jpeg, gif, png', 'maxSize' => Yii::$app->params['uploadMaxFileSize'], 'skipOnEmpty' => true],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_image' => 'Главное изображение',
            'title' => 'Название',
            'description' => 'Описание',
            'content' => 'Контент',
            'slug' => 'Слогин',
            'can_edit' => 'Возможно редактировать',
            'on_slider' => 'На слайдере',
            'views_count' => 'Количество просмотров',
            'user_id' => 'Пользователь',
            'module' => 'Модуль',
            'author' => 'Автор',
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
            'on_main' => 'На главной',
            'news_status_id' => 'Статус новости'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsStatus()
    {
        return $this->hasOne(NewsStatus::className(), ['id' => 'news_status_id']);
    }

    /**
    public function getAlbums()
    {

    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->getNewsStatus() === true;
    }

    /**
     * @return boolean
     */
    public function isCanEdit()
    {
        return $this->can_edit;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getArticlesOnSlider()
    {
        $values = self::find()
            ->select([
                'id',
                'main_image',
                'title',
                'description',
                'slug',
                'author',
                'updated_at'
            ])
            ->where([
                'news_status_id' => NewsStatus::PUBLISHED,
                'on_slider' => true
            ])
            ->asArray()
            ->all();
        foreach ($values as &$value) {
            $value['src'] = '/upload/news/' . $value['id'] . '/images/medium/' . $value['main_image'];
            $value['href'] = '/news/' . $value['id'];
        }
        return $values;
    }
}
