<?php

namespace modules\post\backend\controllers;

use \yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;


class UploadController extends Controller
{
    public function behaviors()
    {
        $this->enableCsrfValidation = false;
        return [];
    }

    public function actionIndex(){
        $params = Yii::$app->request->queryParams;
        $CKEditorFuncNum = $params['CKEditorFuncNum'];

        $image = UploadedFile::getInstanceByName('upload');

        if (!$this->isValid($image)){
            $response = 'alert(\'Ошибка загрузки файла!\')';
        }else{
            $pathToImage = Yii::$app->params['uploadDir'].'/post/images/medium/'.$image->baseName.'.'.$image->extension;
            if ($image->saveAs($pathToImage)){
                $width = 1000;
                $height = $this->heightByWidth($width, $pathToImage);
                Image::thumbnail($pathToImage, $width, $height)->save($pathToImage, ['quality'=> 100]);
                $width = 200;
                $height = $this->heightByWidth($width, $pathToImage);
                $pathToThumb = str_replace('medium', 'mini', $pathToImage);
                Image::thumbnail($pathToImage, $width, $height)->save($pathToThumb, ['quality'=> 100]);
                $url = 'http://'.Yii::$app->params['rootDomain'].'/upload/post/images/medium/'.$image->baseName.'.'.$image->extension;
                $response = sprintf("window.parent.CKEDITOR.tools.callFunction(%s, '%s', '%s')", $CKEditorFuncNum, $url, 'Файл успешно загружен!');
            }else{
                $response = 'alert(\'Ошибка загрузки файла!\')';
            }
        }
        header('Content-type: text/html; charset=utf-8');
        echo '<script>'.$response.';</script>';
        exit;
    }

    /**
     * @return string
     */
    public function isValid(UploadedFile $image)
    {
        $imgExtensions = ['jpg','jpeg','png','bmp','gif'];
        $extension = $image->extension;
        if (!array_intersect([$extension], $imgExtensions)){
            return false;
        }elseif ($image->size > 1024 * 1024 * 8){
            return false;
        }
        return true;
    }

    /**
     * @return integer
     */
    public function heightByWidth($width, $pathToImage)
    {
        $uploadedImage = Image::getImagine()->open(Yii::getAlias($pathToImage));
        $imageSize = $uploadedImage->getSize();
        $ratio = $imageSize->getWidth()/$imageSize->getHeight();
        $height = round($width/$ratio);
        return $height;
    }
}