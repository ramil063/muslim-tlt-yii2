<?php

use yii\db\Migration;

class m180802_121848_relations extends Migration
{
    public function safeUp()
    {
        $this->createTable('relation', [
            'id' => $this->primaryKey(),
            'from_entity' => $this->string(500),
            'from_entity_id' => $this->integer(),
            'to_entity' => $this->string(500),
            'to_entity_id' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('relation');
    }
}
