<?php

namespace frontend\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;


/**
 * Class SiteController
 * @package frontend\controllers
 */
class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionFeedback()
    {
        $this->layout = Yii::$app->params['otherLayoutName'];
        return $this->render('feedback');
    }

    /**
     * @throws Exception
     */
    public function actionError()
    {
        throw new Exception('not found', 404);
    }
}