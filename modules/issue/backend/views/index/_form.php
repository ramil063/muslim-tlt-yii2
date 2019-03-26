<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Issue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a('Назад', ['index'], ['class' => 'btn btn-block btn-default btn-sm']) ?>
        </h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="row">
        <div class="col-md-8">
                <?php $form = ActiveForm::begin(); ?>
                <div class="box-body">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

                    <?= $form->field($model, 'completed')->checkbox() ?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
