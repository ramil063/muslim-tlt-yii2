<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\Menu;

//use eleiva\noty\Noty;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .select2-container .select2-selection--single .select2-selection__rendered{
                margin-top:0px!important;;
            }
            div.datepicker-year{
                padding-bottom: 7px;
            }
            .grid-preview{
                width: 100px;
            }
            .small-box .icon{
                font-size: 64px!important;
            }
            .box-gridster{
                height: 100%;
            }
            .gs-w{
                list-style: none;
            }
            .gridster .player {
                -webkit-box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
                box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
                background: #BBB;
            }
            .gridster .preview-holder {
                border: none !important;
                border-radius: 0 !important;
                background: #f39c12 !important;
                list-style:none;
            }
            /*        .gragging.player
                    {
                        background: #808080!important;
                    }*/
        </style>

<!--        --><?// if(($message = Yii::$app->session->getFlash('success'))):?>
<!--            --><?//=Noty::widget([
//                'text' => $message,
//                'type' => Noty::SUCCESS,
//                'useAnimateCss' => true,
//                'clientOptions' => [
//                    'timeout' => 6000,
//                    'layout' => 'topRight',
//                    'dismissQueue' => true,
//                    'theme' => 'relax',
//                    'animation' => [
//                        'open' => 'animated bounceInDown',
//                        'close' => 'animated fadeOutUp',
//                        'easing' => 'swing',
//                        'speed' => 500
//                    ]
//                ]
//            ]);?>
<!--        --><?// endif;?>
<!--        --><?// if ($message = Yii::$app->session->getFlash('danger')): ?>
<!--            --><?//=Noty::widget([
//                'text' => $message,
//                'type' => Noty::ERROR,
//                'useAnimateCss' => true,
//                'clientOptions' => [
//                    'timeout' => 6000,
//                    'layout' => 'topRight',
//                    'dismissQueue' => true,
//                    'theme' => 'relax',
//                    'animation' => [
//                        'open' => 'animated bounceInDown',
//                        'close' => 'animated fadeOutUp',
//                        'easing' => 'swing',
//                        'speed' => 500
//                    ]
//                ]
//            ]);?>
<!--        --><?// endif;?>
<!--        --><?// if ($message = Yii::$app->session->getFlash('warning')): ?>
<!--            --><?//=Noty::widget([
//                'text' => $message,
//                'type' => Noty::WARNING,
//                'useAnimateCss' => true,
//                'clientOptions' => [
//                    'timeout' => 6000,
//                    'layout' => 'topRight',
//                    'dismissQueue' => true,
//                    'theme' => 'relax',
//                    'animation' => [
//                        'open' => 'animated bounceInDown',
//                        'close' => 'animated fadeOutUp',
//                        'easing' => 'swing',
//                        'speed' => 500
//                    ]
//                ]
//            ]);?>
<!--        --><?// endif;?>
<!--        --><?// if ($message = Yii::$app->session->getFlash('info')): ?>
<!--            --><?//=Noty::widget([
//                'text' => $message,
//                'type' => Noty::INFORMATION,
//                'useAnimateCss' => true,
//                'clientOptions' => [
//                    'timeout' => 6000,
//                    'layout' => 'topRight',
//                    'dismissQueue' => true,
//                    'theme' => 'relax',
//                    'animation' => [
//                        'open' => 'animated bounceInDown',
//                        'close' => 'animated fadeOutUp',
//                        'easing' => 'swing',
//                        'speed' => 500
//                    ]
//                ]
//            ]);?>
<!--        --><?// endif;?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>MT</b>A</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Muslim-tlt</b>Admin</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- User Account: style can be found in dropdown.less -->
                        <? $userIdentity = Yii::$app->user->getIdentity();?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/dist/img/avatar5.png" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?=$userIdentity->fname.' '.$userIdentity->lname;?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/dist/img/avatar5.png" class="img-circle" alt="User Image">

                                    <p>
                                        <?=$userIdentity->fname.' '.$userIdentity->lname;?>
                                        <!--<small>Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!--                            <li class="user-body">
                                                                <div class="row">
                                                                    <div class="col-xs-4 text-center">
                                                                        <a href="#">Followers</a>
                                                                    </div>
                                                                    <div class="col-xs-4 text-center">
                                                                        <a href="#">Sales</a>
                                                                    </div>
                                                                    <div class="col-xs-4 text-center">
                                                                        <a href="#">Friends</a>
                                                                    </div>
                                                                </div>
                                                            </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <!--<a href="#" class="btn btn-default btn-flat">Профиль</a>-->
                                    </div>
                                    <div class="pull-right">
                                        <a href="/core/index/logout" class="btn btn-default btn-flat">Выход</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <!--<div class="user-panel">
                    <div class="pull-left image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Alexander Pierce</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>-->
                <!-- search form -->
                <!--<form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                    </div>
                </form>-->
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?
                $controller = Yii::$app->controller->id;
                $module = Yii::$app->controller->module->id;
                $param = Yii::$app->getRequest()->get('resource');
                echo \common\widgets\Menu::widget([
                    'items' => [
                        ['label' => 'Главная', 'url' => ['/'], 'icon' => 'fa fa-dashboard', 'active' => $module == 'core' && $controller == 'index'],
                        [
                            'label' => 'Пользователи',
                            'url' => ['#'],
                            'icon' => 'fa fa-users',
                            'options'=>['class' => 'treeview'],
                            'permissions' => 'user',
                            'items' => [
                                ['label' => 'Список пользователей', 'url' => ['/user'], 'icon' => 'fa fa-circle-o', 'permissions' => 'user.index.index', 'active' => ($module == 'user' && $controller == 'index')],
//                                ['label' => 'Роли', 'url' => ['/user/role'], 'icon' => 'fa fa-circle-o', 'permissions' => 'user.role.index', 'active' => ($module == 'user' && $controller == 'role')],
//                                ['label' => 'Ресурсы', 'url' => ['/user/resource'], 'icon' => 'fa fa-circle-o', 'permissions' => 'user.resource.index', 'active' => ($module == 'user' && $controller == 'resource')],
                            ],
                        ],
                        ['label' => 'Время намазов', 'url' => ['/namaz/namaz'], 'icon' => 'fa fa-circle-o', 'active' => ($module == 'namaz' && in_array($controller, ['namaz']))],
                        ['label' => 'Хадисы', 'url' => ['/hadis/index'], 'icon' => 'fa fa-circle-o', 'active' => ($module == 'hadis' && in_array($controller, ['index']))],
                        ['label' => 'Запросы', 'url' => ['/issue/index'], 'icon' => 'fa fa-circle-o', 'active' => ($module == 'issue' && in_array($controller, ['index']))],
                        ['label' => 'Публикации', 'url' => ['/post/post/index'], 'icon' => 'fa fa-circle-o', 'active' => ($module == 'post' && in_array($controller, ['post']))],
                        ['label' => 'Фото/Видео Альбомы', 'url' => ['/media/album'], 'icon' => 'fa fa-circle-o', 'permissions' => 'media.album.index', 'active' => ($module == 'media' && in_array($controller, ['album']))]
                    ],
                    'activateParents' => true,
                    'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                    'options' => [
                        'class' => 'sidebar-menu'
                    ]
                ]);
                ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?= $this->render('//partials/_breadcrumbs'); ?>

            <!-- Main content -->
            <section class="content">

                <?= $content ?>

            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.6
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="http://etton.ru">Etton</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-user bg-yellow"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                    <p>New phone +1(800)555-1234</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                    <p>nora@example.com</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                    <p>Execution time 5 seconds</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-warning pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right">
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                            </label>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>