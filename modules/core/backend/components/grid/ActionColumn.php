<?php

namespace modules\core\backend\components\grid;

use Yii;

class ActionColumn extends \yii\grid\ActionColumn
{
    /**
     * @var null|bool|array
     */
    public $permissions;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->processPermissions();
    }

    /**
     * @inheritdoc
     */
    protected function processPermissions()
    {
        if($this->permissions){
            $permissions = [];
            if(is_bool($this->permissions)){
                // Применение относительно текущего модуля и контроллера
                if(preg_match_all('#{([\w\-\/]+)}#', $this->template, $matches)){
                    foreach($matches[1] as $permission){
                        $permissions[$permission] = implode('.', [
                            Yii::$app->controller->module->id,
                            Yii::$app->controller->id,
                            $permission
                        ]);
                    }
                }
            }elseif(is_array($this->permissions)){
                // Индивидуально указанные разрешения на элементы управления
                $permissions = $this->permissions;
            }

            foreach($permissions as $button => $accessPermission){
                if(!Yii::$app->user->can($accessPermission)){
                    $buttonTemplate = '{'.$button.'}';
                    $this->template = trim(str_replace($buttonTemplate, '', $this->template));
                }
            }
        }
    }
}