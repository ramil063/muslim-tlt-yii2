<?php

use yii\db\Migration;

/**
 * Class m181207_124755_issue_tables
 */
class m181207_124755_issue_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('issue', [
            'id' => $this->primaryKey()->comment('ID'),
            'email' => $this->text()->notNull()->comment('Адрес эл. почты'),
            'user_name' => $this->text()->notNull()->comment('Как к вам обращаться'),
            'content' => $this->text()->comment('Текст сообщения'),
            'created_at' => $this->dateTime()->notNull()->comment('Создано'),
            'completed' => $this->boolean()->defaultValue(false)->comment('Завершено'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('issue');
    }
}
