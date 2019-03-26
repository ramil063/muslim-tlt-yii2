<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\media\backend\models\search\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Медиа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">

    <?=$this->render('@modules/media/backend/views/album/parts/_tabs', [
        'album' => $album,
        'buttons' => [
            Html::a('Назад', ['album/index'], ['class' => 'btn btn-default btn-sm']),
            Html::a('Добавить...', ['media/create', 'album_id' => $album->id], ['class' => 'btn btn-success btn-sm']),
        ]
    ]);?>
    <div class="box-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Изображение',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::img($model->getThumbFileUrl('link', 'mini', '/images/placeholder.jpg'), ['class' => 'grid-preview']);
                    },
                ],
                'title',
                [
                    'attribute' => 'media_type_id',
                    'value' => function ($data) {
                        return $data->getMediaType()->one()->title;
                    },
                    'filter' => \common\models\MediaType::getForDropdownList()
                ],
                [
                    'class' => 'common\grid\BooleanColumn',
                    'attribute' => 'on_slider',
                ],
                [
                    'class' => 'modules\core\backend\components\grid\ActionColumn',
                    'template' => '{update}  {delete}',
                    'headerOptions' => ['style' => 'width:50px;'],
                    'permissions' => true
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
