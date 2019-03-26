<?php

use yii\db\Migration;

class m170717_130005_alter_tables extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE `user`
            ADD COLUMN `salt`  varchar(100) NULL AFTER `last_activity_date`');
        $this->execute('ALTER TABLE `user`
            ADD COLUMN `code_activate`  varchar(100) NULL AFTER `salt`');

        $this->insert('user', [
            'login' => 'ramil_063',
            'password' => '8113450b3d9bd6dd5328a7272a7d2dc1',
            'email' => 'ramil_063@mail.ru',
            'salt' => '740ca30c-f4bd-11e4-b9b2-1697f925ec7b'
        ]);
    }

    public function down()
    {
        $this->execute('ALTER TABLE `user` DROP COLUMN `salt`');
        $this->execute('ALTER TABLE `user` DROP COLUMN `code_activate`');
    }
}
