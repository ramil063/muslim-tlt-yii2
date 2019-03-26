<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\post\backend\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <? if(Yii::$app->user->can(Yii::$app->controller->module->id.'.post.create')):?>
                <?= Html::a('Добавить...', ['create'], ['class' => 'btn btn-block btn-success btn-sm']) ?>
            <? endif;?>
        </h3>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="box-body">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'label' => 'Изображение',
                        'format' => 'raw',
                        'value' => function($model){
                            return Html::img($model->getThumbFileUrl('main_image', 'mini', '/images/placeholder.jpg'), ['class' => 'grid-preview']);
                        },
                    ],
                    'title',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                        'filter' => \kartik\daterange\DateRangePicker::widget(
                            [
                                'model' => $searchModel,
                                'attribute' => 'created_at',
                                'pluginOptions'=>[
                                    'locale'=>[
                                        'format'=>'Y-MM-DD',
                                        'separator'=>' до ',
                                        'startAttribute' => 'datetime_start',
                                        'endAttribute' => 'datetime_end',
                                    ],
                                ],
                            ])
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                        'filter' => \kartik\daterange\DateRangePicker::widget(
                            [
                                'model' => $searchModel,
                                'attribute' => 'updated_at',
                                'pluginOptions'=>[
                                    'locale'=>[
                                        'format'=>'Y-MM-DD',
                                        'separator'=>' до ',
                                        'startAttribute' => 'datetime_start',
                                        'endAttribute' => 'datetime_end',
                                    ],
                                ],
                            ])
                    ],
                    [
                        'attribute' => 'rubric_id',
                        'value' => function ($data){
                            return $data->getRubric()->one()->title;
                        },
                        'filter' => \common\models\Rubric::getForDropdownList()
                    ],
                    [
                        'class' => 'common\grid\BooleanColumn',
                        'attribute' => 'on_slider',
                    ],
                    [
                        'class' => 'common\grid\BooleanColumn',
                        'attribute' => 'on_main',
                    ],
                    [
                        'class' => 'modules\core\backend\components\grid\ActionColumn',
                        'template'=>'{update}  {delete}',
                        'headerOptions' => ['style' => 'width:50px;'],
                        'permissions' => true
                    ],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
