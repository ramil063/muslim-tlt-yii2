<?php
/* @var $this yii\web\View */
/* @var $model common\models\FridaySermon */

$this->title = 'Альбом: Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Альбом', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
