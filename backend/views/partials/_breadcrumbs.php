<?php

use yii\widgets\Breadcrumbs;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?=$this->title;?></h1>
    <?=Breadcrumbs::widget([
        'tag' => 'ol',
        'itemTemplate' => "<li>{link}</li>\n",
        'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : null,
    ]);?>
    <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>-->
</section>