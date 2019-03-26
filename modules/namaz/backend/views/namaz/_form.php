<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Namaz */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a('Назад', ['index'], ['class' => 'btn btn-block btn-default btn-sm']) ?>
        </h3>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

            <?php $form = ActiveForm::begin(); ?>
            <div class="box-body">
                <?= $form->field($model, 'day')->textInput() ?>

                <?= $form->field($model, 'month')->textInput() ?>

                <?= $form->field($model, 'fajr')->textInput() ?>

                <?= $form->field($model, 'rasvet')->textInput() ?>

                <?= $form->field($model, 'asr')->textInput() ?>

                <?= $form->field($model, 'magrib')->textInput() ?>

                <?= $form->field($model, 'isha')->textInput() ?>
            </div>
            <div class="box-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>

        </div>



        <?php ActiveForm::end(); ?>
    </div>
</div>
