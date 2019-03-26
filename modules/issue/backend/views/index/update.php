<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Запросы: Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Запросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
