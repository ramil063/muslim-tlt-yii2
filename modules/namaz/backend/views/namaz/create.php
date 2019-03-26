<?php
/* @var $this yii\web\View */
/* @var $model common\models\Namaz */

$this->title = 'Время намаза: Создание';
$this->params['breadcrumbs'][] = ['label' => 'Время намаза', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
