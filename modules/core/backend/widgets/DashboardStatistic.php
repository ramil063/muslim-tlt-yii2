<?php

namespace modules\core\backend\widgets;

use yii\base\Widget;

class DashboardStatistic extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('dashboard-statistic', [
//            'moderatedPostCount' => Post::find()->where('post_status_id = :status', ['status' => PostStatus::STATUS_MODERATED])->andWhere('published = true')->count(),
//            'moderationPostCount' => Post::find()->where('post_status_id = :status', ['status' => PostStatus::STATUS_MODERATION])->count(),
//            'moderatedCommentCount' => PostComment::find()->where('post_status_id = :status', ['status' => PostStatus::STATUS_MODERATED])->count(),
//            'moderationCommentCount' => PostComment::find()->where('post_status_id = :status', ['status' => PostStatus::STATUS_MODERATION])->count()
        ]);
    }
}