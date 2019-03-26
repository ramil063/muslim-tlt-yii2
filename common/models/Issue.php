<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "issue".
 *
 * @property int $id ID
 * @property string $email Адрес эл. почты
 * @property string $user_name Как к вам обращаться
 * @property string $content Текст сообщения
 * @property string $created_at Создано
 * @property int $completed Завершено
 */
class Issue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'issue';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = [];
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'updatedAtAttribute' => false,
            'value' => function () {
                 return date('Y-m-d H:i:s');
            }
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'user_name'], 'required'],
            [['email', 'user_name', 'content'], 'string'],
            [['created_at'], 'safe'],
            [['completed'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Адрес эл. почты',
            'user_name' => 'Как к вам обращаться',
            'content' => 'Текст сообщения',
            'created_at' => 'Создано',
            'completed' => 'Завершено',
        ];
    }
}
