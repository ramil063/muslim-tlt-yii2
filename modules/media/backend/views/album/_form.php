<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\core\components\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\FridaySermon */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="nav-tabs-custom">

    <?= $this->render('@modules/media/backend/views/album/parts/_tabs', [
        'album' => $model,
        'buttons' => [
            Html::a('Назад', ['index'], ['class' => 'btn btn-default btn-sm']),
        ]
    ]); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'media_type_id')->dropDownList(
            \common\models\MediaType::find()->select(['title', 'id'])->indexBy('id')->column(),
            ['prompt' => 'Выберите тип']
        ); ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
