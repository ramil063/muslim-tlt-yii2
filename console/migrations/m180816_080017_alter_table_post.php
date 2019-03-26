<?php

use yii\db\Migration;

class m180816_080017_alter_table_post extends Migration
{
    public function safeUp()
    {
        $this->addColumn('post', 'published', $this->boolean());
    }

    public function safeDown()
    {

    }
}
