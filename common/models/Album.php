<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "album".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $user_id
 * @property string $media_type_id
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MediaType $mediaType
 * @property User $user
 * @property Media[] $media
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
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
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_type_id'], 'required'],
            [['user_id', 'media_type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
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
            'title' => 'Название',
            'description' => 'Описание',
            'user_id' => 'Пользователь',
            'media_type_id' => 'Тип',
            'slug' => 'Слогин',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['album_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getForDropdownList()
    {
        return ArrayHelper::map(static::find()->orderBy('title ASC')->all(), 'id' , 'title');
    }
}
