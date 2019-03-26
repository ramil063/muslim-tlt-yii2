<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news_status".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 */
class NewsStatus extends \yii\db\ActiveRecord
{
    const PUBLISHED = 1;

    const NOT_PUBLISHED = 2;

    const IN_ARCHIVE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_status';
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
     * @return array
     */
    public static function getForDropdownList()
    {
        $query = static::find()->orderBy('title ASC');
        return ArrayHelper::map($query->all(),'id','title');
    }
}
