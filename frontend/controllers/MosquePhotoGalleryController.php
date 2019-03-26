<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;


/**
 * Class MosquePhotoGalleryController
 * @package frontend\controllers
 */
class MosquePhotoGalleryController extends Controller
{
    public $layout = 'other';

    /**
     * @return string
     */
    public function actionIndex()
    {
        $images = [];
        $dir = Yii::$app->params['mosquePhotoGalleryUploadDir'];
        $mediumImages = FileHelper::findFiles($dir);
        foreach ($mediumImages as $image) {
            $path = explode('web/', FileHelper::normalizePath($image, '/'));
            $path = end($path);
            $im['medium_image'] = $path;
            $im['mini_image'] = str_replace('medium', 'mini', $path);
            $images[] = $im;
        }
        return $this->render('index', [
            'images' => $images
        ]);
    }
}