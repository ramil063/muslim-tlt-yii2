<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "media_type".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 *
 * @property Album[] $albums
 * @property Media[] $media
 */
class MediaType extends \yii\db\ActiveRecord
{
    /**
     *
     */
    const PHOTO_ID = 1;

    /**
     *
     */
    const VIDEO_ID = 2;

    /**
     *
     */
    const HREF_ID = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            [['title', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['media_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['media_type_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getForDropdownList()
    {
        $query = static::find()->orderBy('title ASC');
        return ArrayHelper::map($query->all(),'id','title');
    }
}
