<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Новости: Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
