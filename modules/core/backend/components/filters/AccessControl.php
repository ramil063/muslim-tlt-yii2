<?php

namespace modules\core\backend\components\filters;

use Yii;
use yii\web\ForbiddenHttpException;

class AccessControl extends \yii\filters\AccessControl
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        return true;
        if(parent::beforeAction($action)){
            if(Yii::$app->user->can($this->getPermissionName())){
                return true;
            }
        }

        $this->denyAccess($this->user);
        return false;
    }

    /**
     * @return string
     */
    private function getPermissionName()
    {
        return implode('.', [
            Yii::$app->controller->module->id,
            Yii::$app->controller->id,
            Yii::$app->controller->action->id
        ]);
    }
}
