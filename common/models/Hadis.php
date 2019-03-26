<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "hadis".
 *
 * @property int $id
 * @property int $num
 * @property string $hadis-text
 */
class Hadis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hadis';
    }


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => function () {
                    return date('Y-m-d H:i:s');
                }
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num'], 'integer'],
            [['published'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => 'Номер',
            'published' => 'Опубликовано',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'text' => 'Текст',
        ];
    }
}
