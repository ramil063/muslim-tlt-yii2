<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rubric".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 */
class Rubric extends ActiveRecord
{
    const NEWS_CODE = 'news';
    const FRIDAY_SERMON_CODE = 'friday_sermon';
    const POST_CODE = 'post';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rubric';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'string', 'max' => 500],
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
            'code' => 'Код',
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

    /**
     * @param $code
     * @return Rubric|null
     */
    public static function getRubricId($code)
    {
        return self::findOne([
            'code' => $code,
        ]);
    }
}
