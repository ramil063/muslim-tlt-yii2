<?php

namespace common\models\dto;

use common\models\Album;
use common\models\Post;
use common\models\Relation;


/**
 * Class ArticlesTransferObject
 * @package common\models
 */
class ArticlesTransferObject extends TransferObject
{
    /**
     * @var
     */
    protected $articles;

    /**
     * @var
     */
    protected $module;

    /**
     * ArticlesTransferObject constructor.
     * @param $module
     * @param $articles
     */
    function __construct($module, $articles)
    {
        $this->module = $module;
        $this->articles = $articles;
    }

    /**
     * @return mixed
     */
    public function getAllArticlesData()
    {
        $return = [];
        if ($this->articles) {
            foreach ($this->articles as $article) {
                $album = $this->prepareAlbumMedia($article);
                $return[] = $this->getArticleData($article, $album);
            }
        }
        return $return;
    }

    /**
     * @param Post $article
     * @return array
     */
    private function prepareAlbumMedia($article)
    {
        $albumId = Relation::getRelatedAlbum($article::className(), $article->id);
        if (!$albumId) {
            return [];
        }
        $album = Album::findOne($albumId);
        return $this->getMediaDataForArticle($album->getMedia()->all());
    }

    /**
     * @param $article
     * @param $album
     * @return array
     */
    public function getArticleData($article, $album)
    {
        $return = [];
        $miniImage = $mediumImage = '';
        $return['id'] = $article['id'];
        $return['url'] = '/' . $this->module . '/' . $article['slug'];
        if ($article['main_image']) {
            $miniImage = '/upload/post/' . $article['id'] . '/images/mini/' . $article['main_image'];
            $mediumImage = '/upload/post/' . $article['id'] . '/images/medium/' . $article['main_image'];
        }
        $return['mini_image'] = $miniImage;
        $return['medium_image'] = $mediumImage;
        $return['updated_at'] = $article['updated_at'];
        $return['title'] = $article['title'];
        $return['content'] = $article['content'];
        $return['description'] = $article['description'];
        $return['album'] = $album;
        return $return;
    }

    /**
     * @param $medias
     * @return array
     * @internal param $article
     * @internal param $album
     */
    public function getMediaDataForArticle($medias)
    {
        $result = [];
        foreach ($medias as $media) {
            $mAr = [];
            $mAr['id'] = $media->id;
            $mAr['mini_image'] = '/upload/media/' . $media->id . '/images/mini/' . $media->link;
            $mAr['medium_image'] = '/upload/media/' . $media->id . '/images/medium/' . $media->link;
            $mAr['title'] = $media->title;
            $mAr['description'] = $media->description;
            $result[] = $mAr;
        }
        return $result;
    }
}