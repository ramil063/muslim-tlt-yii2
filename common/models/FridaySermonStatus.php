<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "friday_sermon_status".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 *
 * @property FridaySermon[] $fridaySermons
 */
class FridaySermonStatus extends \yii\db\ActiveRecord
{
    const PUBLISHED = 1;

    const NOT_PUBLISHED = 2;

    const IN_ARCHIVE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friday_sermon_status';
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
    public function getFridaySermons()
    {
        return $this->hasMany(FridaySermon::className(), ['friday_sermon_status_id' => 'id']);
    }
}
