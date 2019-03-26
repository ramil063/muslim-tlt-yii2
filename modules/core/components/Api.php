<?php

namespace modules\core\components;

use Yii;
use \yii\filters\auth\CompositeAuth;
use \yii\filters\auth\HttpBasicAuth;
use \yii\filters\auth\QueryParamAuth;
use common\models\VoteAnswerUser;
use \yii\filters\Cors;
use yii\web\Controller;
use \yii\web\Response;


class Api extends Controller
{

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return true;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => QueryParamAuth::className(),
                    'tokenParam' => 'session_token'
                ],
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => false
                ]
            ]
        ];
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
        ];
        return $behaviors;
    }

    public function toArray($object){
        $return = [];
        foreach ($object as $key => $value){
            $return[$key] = $value;
        }
        if (is_object($object)){
            $relatedValues = $object->getRelatedRecords();
            if (is_array($relatedValues)){
                foreach ($relatedValues as $key => $value){
                    if (is_array($value)){
                        $return[$key] = $this->toArray($value);
                    }elseif(is_object($value)){
                        $return[$key] = $this->toArray($value);
                    }
                }
            }
        }elseif (is_array($object)){
            foreach ($object as $key => $value){
                if (is_array($value)){
                    $return[$key] = $this->toArray($value);
                }elseif(is_object($value)){
                    $return[$key] = $this->toArray($value);
                }
            }
        }
        return $return;
    }

    public function userIsLogged(){
        return true;
    }

    public function getUserId(){
        if ($this->userIsLogged())
            return 28;
        return false;
    }
}