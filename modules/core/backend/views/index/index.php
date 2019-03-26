<?
use yii\grid\GridView;
use modules\core\backend\widgets\DashboardStatistic;
?>

<div class="row">
    <?=DashboardStatistic::widget();?>
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Новые пользователи
                </h3>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $userDataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'fname',
                        'lname',
                        'mname',
                        'email',
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>