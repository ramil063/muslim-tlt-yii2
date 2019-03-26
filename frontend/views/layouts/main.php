<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div id="app">
    <?php $this->beginBody() ?>
    <div id="header">
        <div class="inner">
            <div class="homeimg"><a href="/"><img src="/images/home.png"></a></div>
            <div class="slogan">Тольяттинская соборная мечеть имени Диниулова Хариса Хайдаровича</div>
            <div class="slogan2">ул. Ларина, 24 Тел.(8482)22-24-74</div>
            <div class="icon"></div>
        </div>
    </div>
    <navblock></navblock>
    <sliderblock></sliderblock>
    <div class="inner">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div id="left">
            <ayat></ayat>
            <hadis></hadis>
            <namaz></namaz>
        </div>
    </div>
    <div id="footer">
        <div class="inner">
            <div class="navigation">
                <ul class="menu">
                    <li><a href="/litsa-mecheti.html">Лица мечети</a></li>
                    <li><a href="/nashi-partnery.html">Наши партнеры</a></li>
                    <li><a href="/poleznye-ssylki.html">Полезные ссылки</a></li>
                    <li><a href="/feedback">Обратная связь</a></li>
                    <li><a href="/video.html">Видео</a></li>
                    <li><a href="/nashe-polozhenie-na-karte.html">Наше положение на карте</a></li>
                    <li><a href="/poleznye-materialy.html">Полезные материалы</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>