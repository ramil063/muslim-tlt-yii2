<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Хадис: Создание';
$this->params['breadcrumbs'][] = ['label' => 'Хадис', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
