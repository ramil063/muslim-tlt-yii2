<?php
namespace common\grid;

use yii\grid\DataColumn;

class BooleanColumn extends DataColumn
{
    public $format = 'boolean';

    public $filter = [1 => 'Да', 0 => 'Нет'];
}