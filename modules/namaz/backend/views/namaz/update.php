<?php
/* @var $this yii\web\View */
/* @var $model common\models\Namaz */

$this->title = 'Время намаза: Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Время намаза', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
