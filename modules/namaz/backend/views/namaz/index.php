<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\namaz\backend\models\search\NamazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Время намазов';
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
                    'day',
                    'month',
                    'fajr:ntext',
                    'rasvet:ntext',
                    'asr:ntext',
                    'magrib:ntext',
                    'isha:ntext',
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
