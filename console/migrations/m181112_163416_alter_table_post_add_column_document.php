<?php

use yii\db\Migration;

/**
 * Class m181112_163416_alter_table_post_add_column_document
 */
class m181112_163416_alter_table_post_add_column_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'document', $this->string(500));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'document');
    }
}
