<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Введите логин и пароль';
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Muslim-tlt</b>Admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=$this->title;?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?php
        echo $form->field($model, 'username', [
            'template'=>'<div class="form-group has-feedback">{input}{error}<span class="glyphicon glyphicon-envelope form-control-feedback"></span></div>'
        ])->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])
        ?>
        <?php
        echo $form->field($model, 'password', [
            'template'=>'<div class="form-group has-feedback">{input}{error}<span class="glyphicon glyphicon-lock form-control-feedback"></span></div>'
        ])->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autofocus' => true])
        ?>
        <div class="row">
            <!--<div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>-->
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
