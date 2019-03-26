<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Новости: Создание';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
