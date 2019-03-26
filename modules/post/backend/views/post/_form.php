<?php

use common\models\Album;
use common\models\Post;
use common\models\Relation;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\core\components\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<script src="/plugins/ckeditor/ckeditor.js"></script>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a('Назад', ['index'], ['class' => 'btn btn-block btn-default btn-sm']) ?>
        </h3>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <div class="box-body">

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>

                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'main_image')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'initialPreview' => [
                                        $model->getThumbFileUrl('main_image', 'mini', '/images/placeholder.jpg')
                                    ],
                                    'initialPreviewAsData'=>true,
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'layoutTemplates' => ['footer' => ''],
                                    'maxFileSize'=> Yii::$app->params['uploadMaxFileSize']
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'document')->widget(FileInput::class, [
                                'pluginOptions' => [
                                    'initialPreview' => [
                                        $model->getUploadedFileUrl('document')
                                    ],
                                    'initialPreviewAsData'=>true,
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'initialPreviewDownloadUrl' => $model->getUploadPathUrl('document').'/{filename}',
                                    'maxFileSize'=> Yii::$app->params['uploadMaxFileSize'],
                                    'overwriteInitial' => true,
                                    'preferIconicPreview' => true,
                                    'previewFileIconSettings' => [
                                        'other'=> '<i class="fa fa-file text-info"></i>',
                                    ],
                                    'previewFileExtSettings' => [
                                        'other' => new \yii\web\JsExpression('function () { return true; }')
                                    ],
                                    'initialPreviewConfig' => [
                                        ['caption' => $model->document, 'filename' => $model->document]
                                    ],
                                    'layoutTemplates' => ['actions' => '<div class="file-actions"><div class="file-footer-buttons">{download}</div></div>'],
                                ]
                            ]); ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>
                    <script>
                        CKEDITOR.replace( 'post-content', {
                            filebrowserUploadUrl: '/post/upload',
                            extraPlugins: 'imagebrowser',
                            imageBrowser_listUrl: '/post/browse'
                        } );
                    </script>

                    <?= $form->field($model, 'rubric_id')->dropDownList(
                        \common\models\Rubric::find()->select(['title','id'])->indexBy('id')->column(),
                        ['prompt' => 'Выберите рубрику']
                    );?>
                    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'on_slider')->checkbox() ?>

                    <?= $form->field($model, 'on_main')->checkbox() ?>

                    <?= $form->field($model, 'published')->checkbox() ?>

                    <?
                    echo '<div class="form-group field-album-tags">
                        <label class="control-label" for="album-tags">Выберите альбом</label>';
                    echo Select2::widget([
                        'name' => 'Albums',
                        'value' => Relation::getRelatedAlbum($model::className(), $model->id),
                        'data' => Album::getForDropdownList(),
                        'options' => [
                            'placeholder' => 'Выберите альбом',
                            'multiple' => true
                        ],
                    ]);
                    echo '<div class="help-block"></div>
                    </div>';
                    ?>
                </div>

                <div class="box-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
