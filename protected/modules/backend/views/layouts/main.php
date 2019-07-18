<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Title -->
    <title>New Door Realty HQ</title>

    <link rel="icon" type="image/png" href="<?php echo Yii::app()->getModule('main')->assetsUrl; ?>/img/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="E-office for real estate agency" />
    <meta name="keywords" content="" />
    <meta name="author" content="Cybtronix" />

    <!-- Styles -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->renderPartial('backend.views.partial.loader'); ?>
<div class="mn-content fixed-sidebar">
<header class="mn-header navbar-fixed">
    <nav class="cyan darken-1">
        <div class="nav-wrapper row">
            <div class="header-title col s3 m3">
                <a href="<?php echo Yii::app()->homeUrl; ?>">
                    <img id="backendlogo" src="<?php echo Yii::app()->getModule('backend')->assetsUrl; ?>/images/logo-moldrealty_white.png" alt="">
                </a>
            </div>
            <div class="left search col s6 hide-on-small-and-down" style="text-align: center;">
                <span style="font-size: large;"><?php echo $this->title; ?></span>
            </div>
            <ul class="right col s9 m3 nav-right-menu">
                <li class="hide-on-med-and-up"><a href="javascript:void(0)" class="search-toggle"><i class="material-icons">search</i></a></li>
            </ul>
        </div>
    </nav>
</header>
<!-- BEGIN SIDEBAR -->
<?php //$this->widget('Sidebar'); ?>

    <?php $this->widget('BackendMenu', array(
            'items'=>array(
                array(
                    'icon' => 'vpn_key',
                    'label' => Yii::t('BackendModule.backend', 'Реестр недвижимости'),
                    'url' => Yii::app()->createUrl("realty/realty/admin"),
                    'sidebar_tab' => 'realty',
                    'position' => 2,
                    'itemOptions'=>array('class'=>'no-padding'),
                    'linkOptions'=>array('class'=>'collapsible-header waves-effect waves-grey'),
                    'visible'=>!Yii::app()->settings->get(Settings::GENERAL, 'ad_creation') && Yii::app()->user->role != 'content_manager',
                ),
                array(
                    'icon' => 'business',
                    'label' => Yii::t('OfferModule.offer', 'Объявления'),
                    'url' => Yii::app()->createUrl("offer/realtyOffer/admin"),
                    'sidebar_tab' => 'offer',
                    'position' => 1,
                    'visible'=>!Yii::app()->user->isContentManager,
                ),
                array(
                    'icon' => 'business',
                    'label' => Yii::t('OfferModule.offer', 'Обратная связь'),
                    'items'=>array(
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Звонки'),
                            'url' => Yii::app()->createUrl("/backend/requestCallback/admin"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Осмотры'),
                            'url' => Yii::app()->createUrl("/backend/requestVisit/admin"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Аукционы'),
                            'url' => Yii::app()->createUrl("/backend/auction"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Вопросы'),
                            'url' => Yii::app()->createUrl("/backend/feedback"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Подписчики'),
                            'url' => Yii::app()->createUrl("/backend/subscribe"),
                        ),

                        /*array(
                            'label' => Yii::t('OfferModule.offer', 'Комментаторы новостей'),
                            'url' => Yii::app()->createUrl("#"),
                        ),*/
                    ),
                    'visible'=>Yii::app()->user->role != 'content_manager',
                ),
                array(
                    'icon' => 'perm_identity',
                    'label' => Yii::t('BackendModule.backend', 'Сотрудники'),
                    'url' => Yii::app()->createUrl("backend/user/admin"),
                    'sidebar_tab' => 'users',
                    'position' => 3,
                    'visible'=>Yii::app()->user->role == 'admin',
                ),
                array(
                    'icon' => 'settings',
                    'label' => Yii::t('BackendModule.backend', 'Настройки'),
                    'sidebar_tab' => 'settings',
                    'visible'=>Yii::app()->user->role == 'admin' || Yii::app()->user->role == 'content_manager',
                    'active'=>Yii::app()->controller->id == 'settings',
                    'items'=>array(
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Системные настройки'),
                            'url' => Yii::app()->createUrl("backend/settings"),
                            'visible'=>Yii::app()->user->role == 'admin',
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Ваша компания'),
                            'url' => Yii::app()->createUrl("backend/settings/company"),
                        ),
                        array(
                            'label' => Yii::t('MenuModule.menu', 'Меню'),
                            'url' => Yii::app()->createUrl("backend/menu"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Страницы сайта'),
                            'url' => Yii::app()->createUrl("backend/settings/pages"),
                            'visible'=>Yii::app()->user->role == 'admin' || Yii::app()->user->role == 'content_manager',
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Шаблоны писем'),
                            'url' => Yii::app()->createUrl("backend/emailTemplate/admin"),
                        ),                        
                    ),
                ),
                array(
                    'icon' => 'subject',
                    'label' => Yii::t('BlogModule.blog', 'Блог'),
                    'url' => Yii::app()->createUrl("blog/blogArticle/admin"),
                    'sidebar_tab' => 'blog-article',
                    'position' => 4,
                ),
/*                array(
                    'icon' => 'info',
                    'label' => Yii::t('InfoModule.info', 'Услуги агентства'),
                    'url' => Yii::app()->createUrl("info/infoBlock/admin"),
                    'sidebar_tab' => 'info',
                    'position' => 5,
                ),
*/                array(
                    'icon' => 'assignment',
                    'label' => Yii::t('OfferModule.offer', 'Справочники'),
                    'items'=>array(
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Районы'),
                            'url' => Yii::app()->createUrl("/backend/district/admin"),
                            'visible'=>Yii::app()->user->checkAccess(User::ADMIN),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Характеристики объектов'),
                            'url' => Yii::app()->createUrl("/backend/realtyTags/admin"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Строительные серии'),
                            'url' => Yii::app()->createUrl("/backend/buildingProject/admin"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Блоки контента'),
                            'url' => Yii::app()->createUrl("/backend/contentBlock/admin"),
                        ),
                        array(
                            'label' => Yii::t('OfferModule.offer', 'Блоки About'),
                            'url' => Yii::app()->createUrl("/backend/aboutEmployees/admin"),
                        ),
                    ),
                ),
            )
    )); ?>
<!-- END SIDEBAR -->

<main class="mn-inner">

    <?php if (isset($this->breadcrumbs)): ?>
       <?php
//        $this->widget('zii.widgets.CBreadcrumbs', array(
//     $this->widget('application.components.Breadcrumbs', array(
//            'links' => $this->breadcrumbs,
//        ));
?><!-- breadcrumbs -->
    <?php endif; ?>

    <?php echo $content; ?>
</main>

<div class="page-footer">
</div>
</div>
<div class="left-sidebar-hover"></div>
</body>
</html>