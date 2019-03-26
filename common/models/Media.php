<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "media".
 *
 * @property string $id
 * @property integer $link
 * @property string $title
 * @property string $description
 * @property integer $on_slider
 * @property string $user_id
 * @property string $album_id
 * @property string $media_type_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Album $album
 * @property MediaType $mediaType
 * @property User $user
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
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
            'attribute' => 'link',
            'filePath' => Yii::$app->params['uploadDir'].'/media/[[pk]]/images/[[basename]]',
            'fileUrl' => Url::to('//'.Yii::$app->params['rootDomain'].'/upload/media/[[pk]]/images/[[basename]]', $schema),
            'thumbPath' => Yii::$app->params['uploadDir'].'/media/[[pk]]/images/[[profile]]/[[basename]]',
            'thumbUrl' => Url::to('//'.Yii::$app->params['rootDomain'].'/upload/media/[[pk]]/images/[[profile]]/[[basename]]', $schema),
            'thumbs' => [
                'mini' => ['width' => 300, 'height' => 220],
                'medium' => ['width' => 1000, 'height' => 450],
            ],
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id', 'media_type_id'], 'required'],
            [['on_slider', 'user_id', 'album_id', 'media_type_id'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['media_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MediaType::className(), 'targetAttribute' => ['media_type_id' => 'id']],
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
            'link' => 'Ссылка',
            'title' => 'Название',
            'description' => 'Описание',
            'on_slider' => 'На слайдере',
            'user_id' => 'Пользователь',
            'album_id' => 'Альбом',
            'media_type_id' => 'Тип',
            'deleted_at' => 'Удалено',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMediaType()
    {
        return $this->hasOne(MediaType::className(), ['id' => 'media_type_id']);
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
    public static function getSlides()
    {
        $values = self::find()
            ->select([
                'id',
                'link',
                'title',
                'description',
                'updated_at'
            ])
            ->where([
                'on_slider' => true
            ])
            ->asArray()
            ->all();
        foreach ($values as &$value) {
            $value['src'] = '/upload/media/' . $value['id'] . '/images/medium/' . $value['link'];
            $value['href'] = '#';
        }
        return $values;
    }
}
