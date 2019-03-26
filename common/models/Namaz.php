<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "namaz".
 *
 * @property integer $id
 * @property integer $day
 * @property integer $month
 * @property string $fajr
 * @property string $rasvet
 * @property string $asr
 * @property string $magrib
 * @property string $isha
 */
class Namaz extends \yii\db\ActiveRecord
{
    const FAJR = 'fajr';
    const SUNRISE = 'rasvet';
    const ZUHR = 'zuhr';
    const ASR = 'asr';
    const MAGRIB = 'magrib';
    const ISHA = 'isha';

    /**
     * @var array
     */
    public static $namazNames = [
        'fajr' => 'утренний',
        'rasvet' => 'восход',
        'zuhr' => 'обеденный',
        'asr' => 'послеобеденный',
        'magrib' => 'вечерний',
        'isha' => 'ночной',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'namaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day', 'month', 'fajr', 'rasvet', 'asr', 'magrib', 'isha'], 'required'],
            [['day', 'month'], 'integer'],
            [['fajr', 'rasvet', 'asr', 'magrib', 'isha'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'День',
            'month' => 'Месяц',
            'fajr' => 'Время утреннего намаза',
            'rasvet' => 'Рассвет(конец утреннего намаза)',
            'asr' => 'Время аср(послеобеденного) намаза',
            'magrib' => 'Время вечернего намаза',
            'isha' => 'Время ночного намаза',
        ];
    }

    /**
     * @param array $namaz
     * @return array
     */
    public static function getForApiArray(array $namaz)
    {
        return [
            [
                'name' => ArrayHelper::getValue(self::$namazNames, self::FAJR),
                'value' => $namaz[self::FAJR]
            ],
            [
                'name' => ArrayHelper::getValue(self::$namazNames, self::SUNRISE),
                'value' => $namaz[self::SUNRISE]
            ],
            [
                'name' => ArrayHelper::getValue(self::$namazNames, self::ZUHR),
                'value' => '13:05'
            ],
            [
                'name' => ArrayHelper::getValue(self::$namazNames, self::ASR),
                'value' => $namaz[self::ASR]
            ],
            [
                'name' => ArrayHelper::getValue(self::$namazNames, self::MAGRIB),
                'value' => $namaz[self::MAGRIB]
            ],
            [
                'name' => ArrayHelper::getValue(self::$namazNames, self::ISHA),
                'value' => $namaz[self::ISHA]
            ],
        ];
    }
}
