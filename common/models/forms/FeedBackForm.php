<?php

namespace common\models\forms;

/**
 * Class FeedBackForm
 * @package common\models\forms
 */
class FeedBackForm extends \yii\base\Model
{
    public $user_name;
    public $email;
    public $i_agree;
    public $recapcha;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_name', 'email', 'i_agree'], 'required'],
            ['email', 'email'],
        ];
    }
}