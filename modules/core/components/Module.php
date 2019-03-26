<?php

namespace modules\core\components;

use Yii;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->controllerNamespace = 'modules\\'.$this->id.'\\'.Yii::$app->params['appClass'].'\controllers';

        $this->setViewPath('@modules/'.$this->id.'/'.Yii::$app->params['appClass'].'/views');
        Yii::setAlias('@views', $this->getViewPath());
        $this->setLayoutPath('@backend/views/layouts');
    }
}