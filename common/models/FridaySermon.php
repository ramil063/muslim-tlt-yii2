<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "friday_sermon".
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
 * @property string $friday_sermon_status_id
 * @property string $user_id
 * @property string $module
 * @property string $author
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FridaySermonStatus $fridaySermonStatus
 * @property User $user
 */
class FridaySermon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friday_sermon';
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
            'filePath' => Yii::$app->params['uploadDir'].'/friday-sermon/[[pk]]/images/[[basename]]',
            'fileUrl' => Url::to('//'.Yii::$app->params['rootDomain'].'/upload/friday-sermon/[[pk]]/images/[[basename]]', $schema),
            'thumbPath' => Yii::$app->params['uploadDir'].'/friday-sermon/[[pk]]/images/[[profile]]/[[basename]]',
            'thumbUrl' => Url::to('//'.Yii::$app->params['rootDomain'].'/upload/friday-sermon/[[pk]]/images/[[profile]]/[[basename]]', $schema),
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
                'Album' => Yii::$app->request->post('Albums'),
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
            [['content', 'friday_sermon_status_id', 'user_id'], 'required'],
            [['can_edit', 'on_slider', 'views_count', 'friday_sermon_status_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['description', 'author'], 'string', 'max' => 500],
            [['module'], 'string', 'max' => 250],
            [['friday_sermon_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => FridaySermonStatus::className(), 'targetAttribute' => ['friday_sermon_status_id' => 'id']],
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
            'can_edit' => 'Можно редактировать',
            'on_slider' => 'На слайдере',
            'views_count' => 'Количество просмотров',
            'friday_sermon_status_id' => 'Статус',
            'user_id' => 'Пользователь',
            'module' => 'Модуль',
            'author' => 'Автор',
            'deleted_at' => 'Удалено',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFridaySermonStatus()
    {
        return $this->hasOne(FridaySermonStatus::className(), ['id' => 'friday_sermon_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
                'friday_sermon_status_id' => FridaySermonStatus::PUBLISHED,
                'on_slider' => true
            ])
            ->asArray()
            ->all();
        foreach ($values as &$value) {
            $value['src'] = '/upload/friday-sermon/' . $value['id'] . '/images/medium/' . $value['main_image'];
            $value['href'] = '/friday-sermon/' . $value['id'];
        }
        return $values;
    }
}
