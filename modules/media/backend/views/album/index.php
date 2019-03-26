<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\media\backend\models\search\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Альбомы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <? if (Yii::$app->user->can(Yii::$app->controller->module->id . '.album.create')): ?>
                <?= Html::a('Добавить...', ['create'], ['class' => 'btn btn-block btn-success btn-sm']) ?>
            <? endif; ?>
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
                'title',
                'description',
                [
                    'attribute' => 'media_type_id',
                    'value' => function ($data){
                        return $data->getMediaType()->one()->title;
                    },
                    'filter' => \common\models\MediaType::getForDropdownList()
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
