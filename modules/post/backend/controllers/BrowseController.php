<?php

namespace modules\post\backend\controllers;

use Yii;
use yii\web\Controller;

class BrowseController extends Controller
{
    public function actionIndex(){
        $data = [];
        $pattern = sprintf('%s/images/medium/*.{%s}', Yii::$app->params['uploadDir'].'/post', 'jpg,jpeg,bmp,png');
        $files = glob($pattern, GLOB_BRACE);

        if(!empty($files)){
            foreach($files as $file){
                $file = basename($file);
                $file = 'http://'.Yii::$app->params['rootDomain'].'/upload/post/images/medium/'.$file;
                $thumb = str_replace('medium','mini', $file);
                $data[] = [
                    'image' => $file,
                    'thumb' => $thumb,
                    'folder' => ''
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
}