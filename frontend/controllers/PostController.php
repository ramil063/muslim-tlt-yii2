<?php

namespace frontend\controllers;


use common\models\dto\ArticlesTransferObject;
use common\models\Post;
use common\models\Rubric;
use modules\friday_sermon\backend\models\search\FridaySermonSearch;
use modules\post\backend\models\search\PostSearch;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use yii\web\Controller;


class PostController extends Controller
{
    /**
     *
     */
    public function init()
    {
        parent::init();
        $this->layout = Yii::$app->params['otherLayoutName'];
    }

    /**
     * @return string
     */
    public function actionNews()
    {
        $query = Post::find()
            ->where([
                'rubric_id' => Rubric::getRubricId(Rubric::NEWS_CODE)
            ]);

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $a = $query->orderBy('created_at')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $articles = new ArticlesTransferObject('news', $a);
        $posts = $articles->getAllArticlesData();

        return $this->render('index', [
            'sectionTitle' => 'Новости',
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @return string
     */
    public function actionFridaySermon()
    {
        $query = Post::find()
            ->where([
                'rubric_id' => Rubric::getRubricId(Rubric::FRIDAY_SERMON_CODE)
            ]);

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $a = $query->orderBy('created_at')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $articles = new ArticlesTransferObject('friday-sermon', $a);
        $posts = $articles->getAllArticlesData();

        return $this->render('index', [
            'sectionTitle' => 'Новости',
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws Exception
     */
    public function actionView($slug)
    {
        $article = Post::find()
            ->where([
                'slug' => $slug,
                'published' => true
            ])
            ->one();
        if (!$article) {
            throw new Exception('Статья не найдена', 404);
        }
        $articles = new ArticlesTransferObject('', [$article]);
        $post = $articles->getAllArticlesData();
        return $this->render('view', [
            'post' => reset($post)
        ]);
    }
}