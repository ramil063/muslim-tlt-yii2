<?php
use yii\helpers\Html;
?>
<ul class="nav nav-tabs pull-right">
    <? if(!$album->isNewRecord):?>
        <li<? if(in_array(Yii::$app->controller->id, ['media'])):?> class="active"<? endif;?>>
            <?= Html::a('Элементы', ['media/index', 'album_id' => $album->id]) ?>
        </li>
    <? endif;?>
    <li<? if(in_array(Yii::$app->controller->id, ['album'])):?> class="active"<? endif;?>>
        <? if(!$album->isNewRecord):?>
            <?= Html::a('Ред. альбом', ['album/update', 'id' => $album->id]) ?>
        <? else:?>
            <?= Html::a('Создать альбом', ['album/create']) ?>
        <? endif;?>
    </li>
    <li class="pull-left header">
        <div class="box-title btn-group">
            <? if(isset($buttons)):?>
                <?=implode('', $buttons)?>
            <? endif;?>
        </div>
    </li>
</ul>
