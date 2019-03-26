<?php

use yii\db\Migration;

class m180810_103956_alter_some_tables extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('media', 'link', $this->string(500));
        $this->alterColumn('friday_sermon', 'main_image', $this->string(500));
        $this->alterColumn('news', 'main_image', $this->string(500));
    }

    public function safeDown()
    {

    }
}
