<?php
/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = 'Медиа: Создание';
$this->params['breadcrumbs'][] = ['label' => 'Медиа', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<?= $this->render('_form', [
    'model' => $model,
    'album' => $album
]) ?>
