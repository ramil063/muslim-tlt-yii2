<?php

use yii\db\Migration;

/**
 * Class m181121_060217_alter_namaz_table_engine
 */
class m181121_060217_alter_namaz_table_engine extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE namaz ENGINE = InnoDB;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
