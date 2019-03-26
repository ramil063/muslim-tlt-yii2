<?php

use yii\db\Migration;

class m170717_124731_create_table_access_token extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE access_token (
                id int(10) unsigned NOT NULL AUTO_INCREMENT,
                user_id int(10) unsigned NOT NULL,
                provider varchar(50) NOT NULL,
                type varchar(50) NOT NULL,
                credentials varchar(255),
                token varchar(255) NOT NULL,
                refresh_token varchar(255),
                expire int(10),
                expired_at timestamp,
                created_at timestamp NOT NULL,
                updated_at timestamp,
                PRIMARY KEY (id),
                KEY access_token_user_id_foreign (user_id),
                CONSTRAINT `access_token_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
    }

    public function down()
    {
        $this->execute('DROP TABLE IF EXISTS access_token');
    }
}
