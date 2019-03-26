<?php
/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = 'Медиа: Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Медиа', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<?= $this->render('_form', [
    'model' => $model,
    'album' => $album
]) ?>
