<?php

use yii\db\Migration;

class m170718_140609_alter_table_news_main_image_field extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE `news`
            MODIFY COLUMN `main_image`  varchar(500) NOT NULL AFTER `id`');
    }

    public function down()
    {

    }
}
