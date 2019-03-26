<?php

namespace modules\core\components;

use Yii;

class Security
{
    /**
     * @param mixed $data
     * @param null|string $key
     * @return string
     */
    public static function getSignature($data, $key = null)
    {
        $data = array_map(function($value){
            return (string)$value;
        }, $data);

        if(null === $key){
            $key = Yii::$app->params['saltSignature'];
        }

        return hash_hmac('sha256', serialize($data), $key);
    }

    /**
     * @param mixed $data
     * @param string $signature
     * @return bool
     */
    public static function checkSignature($data, $signature)
    {
        $data = array_map(function($value){
            return (string)$value;
        }, $data);

        return hash_hmac('sha256', serialize($data), Yii::$app->params['saltSignature']) === $signature;
    }
}