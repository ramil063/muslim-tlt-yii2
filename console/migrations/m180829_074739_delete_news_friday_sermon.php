<?php

use yii\db\Migration;

class m180829_074739_delete_news_friday_sermon extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('friday_sermon_friday_sermon_status_id_foreign', 'friday_sermon');
        $this->dropTable('friday_sermon');
        $this->dropTable('friday_sermon_status');
        $this->dropTable('news');
        $this->dropTable('news_status');
    }

    public function safeDown()
    {

    }
}
