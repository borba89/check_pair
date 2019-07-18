<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
    <!--<a id="rightmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="left" title="Toggle Infobar"></a>-->

    <div class="navbar-header pull-left">
        <a class="navbar-logo" href="/backend"><?php echo Yii::app()->name; ?> Backend</a>
    </div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs"><?php echo Yii::app()->user->fullName; ?> <i class="fa fa-caret-down"></i></span><img src="<?php echo Yii::app()->user->avatar; ?>" alt="Dangerfield" /></a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#">
                        <div class="pull-left"><img src="<?php echo Yii::app()->user->avatar; ?>" alt="Jeff Dangerfield"/></div>
                        <div class="pull-right"><h5><?php echo Yii::t("backend", "Howdy");?>, <?php echo Yii::app()->user->name; ?>!</h5><small>Logged in as <span><?php echo Yii::app()->user->email; ?></span></small></div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->controller->createUrl('/backend/user/update', array('id' => Yii::app()->user->id)); ?>">Edit Profile <i class="pull-right fa fa-pencil"></i></a></li>
                        <li><a href="<?php echo $this->controller->createUrl('/backend/user/view', array('id' => Yii::app()->user->id)); ?>">Account <i class="pull-right fa fa-cog"></i></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $this->controller->createUrl('/backend/default/logout')?>" class="text-right">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</header>