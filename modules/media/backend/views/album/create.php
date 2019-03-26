<?php
/* @var $this yii\web\View */
/* @var $model common\models\FridaySermon */

$this->title = 'Альбом: Создание';
$this->params['breadcrumbs'][] = ['label' => 'Альбом', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
