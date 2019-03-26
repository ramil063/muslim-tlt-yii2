<?php

use yii\db\Migration;

class m170718_123103_alter_table_news extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE `news`
            ADD COLUMN `news_status_id`  int(10) NOT NULL AFTER `on_main`;');
    }

    public function down()
    {
        $this->execute('ALTER TABLE `news`
            DROP COLUMN `news_status_id`;');
    }
}
