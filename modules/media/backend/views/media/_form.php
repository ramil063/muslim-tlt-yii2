<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\core\components\widgets\FileInput;
use \common\models\MediaType;

/* @var $this yii\web\View */
/* @var $model common\models\Media */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a('Назад', ['index', 'album_id' => $album->id], ['class' => 'btn btn-block btn-default btn-sm']) ?>
        </h3>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <div class="box-body">

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


                <? if ($album->media_type_id == MediaType::PHOTO_ID): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'link')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'initialPreview' => [
                                        $model->getThumbFileUrl('link', 'mini', '/images/placeholder.jpg')
                                    ],
                                    'initialPreviewAsData' => true,
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'layoutTemplates' => ['footer' => ''],
                                    'maxFileSize' => Yii::$app->params['uploadMaxFileSize']
                                ]
                            ]); ?>
                        </div>
                    </div>
                <? else: ?>
                    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                <? endif; ?>

                <?= $form->field($model, 'on_slider')->checkbox() ?>

                <?= $form->field($model, 'media_type_id', ['template' => '{input}'])->hiddenInput(['value' => $album->media_type_id]); ?>

                <?= $form->field($model, 'album_id', ['template' => '{input}'])->hiddenInput(['value' => $album->id]); ?>

            </div>

            <div class="box-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
