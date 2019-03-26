<?php

use yii\db\Migration;

class m180816_071215_post_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('rubric', [
            'id' => $this->primaryKey(),
            'title' => $this->string(500),
            'code' => $this->string(500)
        ]);
        $this->batchInsert('rubric', [
            'title',
            'code'
        ],
            [
                [
                    'новости',
                    'news'
                ],
                [
                    'пятничные проповеди',
                    'friday_sermon'
                ],
                [
                    'публикация',
                    'post'
                ],
            ]);
        //table news
        $this->execute("
            CREATE TABLE `post` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `main_image` varchar(255),
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
              `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
              `content` text COLLATE utf8_unicode_ci,
              `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
              `on_slider` tinyint(1) NOT NULL DEFAULT '0',
              `views_count` int(10) unsigned NOT NULL,
              `user_id` int(10) unsigned NOT NULL,
              `rubric_id` int(10) unsigned NOT NULL,
              `author` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              `on_main` tinyint(1),
              PRIMARY KEY (`id`),
              KEY `post_user_id_fk` (`user_id`),
              CONSTRAINT `post_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ");
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'post_rubric_id_fk',
            'post'
        );
        $this->dropTable('post');
        $this->dropTable('rubric');
    }
}
