<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $main_image
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $slug
 * @property integer $on_slider
 * @property string $views_count
 * @property string $user_id
 * @property string $rubric_id
 * @property string $author
 * @property string $created_at
 * @property string $updated_at
 * @property integer $on_main
 *
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['on_slider', 'views_count', 'user_id', 'rubric_id', 'on_main'], 'integer'],
            [['rubric_id'], 'required'],
            [['published'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['main_image'], 'image', 'extensions' => 'jpg, jpeg, gif, png', 'maxSize' => Yii::$app->params['uploadMaxFileSize'], 'skipOnEmpty' => true],
            [['description', 'author'], 'string', 'max' => 500],
            [['document'], 'file', 'maxSize' => Yii::$app->params['uploadMaxFileSize'], 'skipOnEmpty' => true],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        /**
         * @var $storage StorageManager
         */
        $storage = Yii::$app->storage;
        $behaviors = [];
        $behaviors[] = [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'user_id',
            'updatedByAttribute' => 'user_id'
        ];
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'value' => function () {
                return date('Y-m-d H:i:s');
            }
        ];
        $schema = 'http';
        if (!(Yii::$app instanceof \Yii\console\application)) {
            $schema = Yii::$app->request->getIsSecureConnection() ? 'https' : 'http';
        }
        $behaviors[] = [
            'class' => '\modules\core\components\behaviors\ImageUploadBehavior',
            'attribute' => 'main_image',
            'filePath' => Yii::$app->params['uploadDir'] . '/post/[[pk]]/images/[[basename]]',
            'fileUrl' => Url::to('//'.$storage->getAbsoluteUrl('/upload/post/[[pk]]/images/[[basename]]'), $schema),
            'thumbPath' => Yii::$app->params['uploadDir'] . '/post/[[pk]]/images/[[profile]]/[[basename]]',
            'thumbUrl' => Url::to('//'.$storage->getAbsoluteUrl('/upload/post/[[pk]]/images/[[profile]]/[[basename]]'), $schema),
            'thumbs' => [
                'mini' => ['width' => 300, 'height' => 220],
                'medium' => ['width' => 1000, 'height' => 450],
            ],
        ];
        $behaviors[] = [
            'class' => FileUploadBehavior::class,
            'attribute' => 'document',
            'filePath' => Yii::$app->params['uploadDir'].'/post/[[pk]]/documents/[[basename]]',
            'fileUrl' => Url::to('//'.$storage->getAbsoluteUrl('/upload/post/[[pk]]/documents/[[basename]]'), $schema),
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_image' => 'Изображение',
            'title' => 'Название',
            'description' => 'Описание',
            'content' => 'Контент',
            'slug' => 'Слогин',
            'on_slider' => 'На слайдере',
            'views_count' => 'Количество просмотров',
            'user_id' => 'Пользователь',
            'rubric_id' => 'Рубрика',
            'author' => 'Автор',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'on_main' => 'На главной',
            'published' => 'Опубликовано',
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
    public function getRubric()
    {
        return $this->hasOne(Rubric::className(), ['id' => 'rubric_id']);
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
                'updated_at',
                'rubric_id'
            ])
            ->where([
                'published' => true,
                'on_slider' => true
            ])
            ->asArray()
            ->all();
        foreach ($values as &$value) {
            $rubric = self::getRubricCode($value['rubric_id']);
            $value['src'] = '/upload/post/' . $value['id'] . '/images/medium/' . $value['main_image'];
            $value['href'] = '/' . $rubric->code . '/' . $value['slug'];
        }
        return $values;
    }

    public static function getRubricCode($rubricId)
    {
        return Rubric::findOne($rubricId);
    }
}
