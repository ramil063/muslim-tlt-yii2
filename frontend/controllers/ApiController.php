<?php

namespace frontend\controllers;

use common\models\Ayat;
use common\models\forms\FeedBackForm;
use common\models\FridaySermon;
use common\models\Hadis;
use common\models\Issue;
use common\models\Media;
use common\models\Namaz;
use common\models\News;
use common\models\Post;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\httpclient\Client;
use yii\rest\Controller;

/**
 * Class MediaController
 * @package frontend\controllers
 */
class ApiController extends Controller
{
    /**
     * @var string
     */
    public $modelClass = 'common\models\Album';

    /**
     * @return array
     */
    public function actionSlider()
    {
        $posts = Post::getArticlesOnSlider();
        $medias = Media::getSlides();
        $slides = array_merge($posts, $medias);
        $i = 1;
        foreach ($slides as &$slide) {
            $slide['class_name'] = 'slide slide--' . $i++;
        }
        return [
            'slides' => $slides
        ];
    }

    /**
     * @return array
     */
    public function actionMosquePhotoGallery()
    {
        $images = [];
        $dir = Yii::$app->params['uploadDir'] . '\\mosque-photogalery\\medium\\';
        $mediumImages = FileHelper::findFiles($dir);
        foreach ($mediumImages as $image) {
            $path = explode('web/', FileHelper::normalizePath($image, '/'));
            $path = end($path);
            $im['href'] = $path;
            $im['src'] = str_replace('medium', 'mini', $path);
            $images[] = $im;
        }
        return [
            'images' => $images
        ];
    }

    /**
     * @return array
     */
    public function actionDailyNamazTimes()
    {
        $date = new \DateTime();
        $namazToday = Namaz::find()
            ->where([
                'day' => $date->format('d'),
                'month' => $date->format('n'),
            ])
            ->asArray()
            ->one();
        $date->modify('+1 day');
        $namazTomorrow = Namaz::find()
            ->where([
                'day' => $date->format('d'),
                'month' => $date->format('n'),
            ])
            ->asArray()
            ->one();
        return [
            'namaz' => [
                [
                    'period' => 'сегодня',
                    'data' => Namaz::getForApiArray($namazToday),
                ],
                [
                    'period' => 'завтра',
                    'data' => Namaz::getForApiArray($namazTomorrow),
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function actionHadis()
    {
        $hadises = Hadis::find()->where([
            'published' => true
        ])
            ->asArray()
            ->all();
        $key = array_rand($hadises);
        return [
            'hadis' => $hadises[$key]
        ];
    }

    /**
     * @return array
     */
    public function actionAyat()
    {
        $ayats = Ayat::find()->where([
            'published' => true
        ])
            ->asArray()
            ->all();
        $key = array_rand($ayats);
        return [
            'koran' => $ayats[$key]
        ];
    }

    /**
     *
     */
    public function actionIssueAdd()
    {
        $model = new FeedBackForm();
        $post = Yii::$app->request->post();
        if ($model->load(['FeedBackForm' => $post]) && $model->validate()) {
            $issue = new Issue();
            $issue->setAttributes($post);
            if ($issue->save()) {
                Yii::$app->response->statusCode = 200;
            }
        } else {
            Yii::$app->response->statusCode = 500;
            return $model->getErrors();
        }
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function actionGRecapcha()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('https://www.google.com/recaptcha/api/siteverify')
            ->setData([
                'secret' => '6Lf5U4AUAAAAAAl3YkAN9XS9C2PPVJKYoXC5L0ss',
                'response' => Yii::$app->request->post('token')
            ])
            ->send();
        if ($response->isOk) {
            $data = $response->getData();
            if ($data['success'] && $data['score'] > 0.5) {
                Yii::$app->response->statusCode = 200;
            }
            exit;
        }
        Yii::$app->response->statusCode = 500;
    }
}