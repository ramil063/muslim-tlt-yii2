<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ayat".
 *
 * @property int $id
 * @property int $num
 * @property int $sura
 * @property int $ayat
 * @property string $text
 * @property int $published
 * @property string $created_at
 * @property string $updated_at
 */
class Ayat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ayat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num', 'sura', 'ayat', 'published'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => 'Num',
            'sura' => 'Номер суры',
            'ayat' => 'Номер аята',
            'text' => 'Текст',
            'published' => 'Опубликовано',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }
}
