<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\issue\backend\models\search\IssueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a('Добавить...', ['create'], ['class' => 'btn btn-block btn-success btn-sm']) ?>
        </h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'user_name',
                    [
                        'attribute' => 'created_at',

                        'filter' => \yii\jui\DatePicker::widget(
                            [
                                'model' => $searchModel,
                                'attribute' => 'created_at',
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => [
                                    'class' => 'form-control'
                                ],
                            ])
                    ],
                    'content',
                    [
                        'class' => 'common\grid\BooleanColumn',
                        'attribute' => 'completed',
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
