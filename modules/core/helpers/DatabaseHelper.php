<?php

namespace modules\core\helpers;

use yii\db\Migration;

class DatabaseHelper
{
    public static function actualizeSequence(Migration $migration, $tableName)
    {
        $migration->execute("SELECT setval(pg_get_serial_sequence('$tableName', 'id'), (SELECT MAX(id) FROM $tableName));");
    }
}