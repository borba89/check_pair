<aside id="slide-out" class="side-nav white fixed">
    <div class="side-nav-wrapper">
        <div class="sidebar-profile">
            <!--<div class="sidebar-profile-image">
                <img src="<?php /*echo Yii::app()->user->avatar; */?>" class="circle" alt="">
            </div>-->
            <div class="sidebar-profile-info">
                <a href="<?php echo Yii::app()->createUrl('/backend/user/view', array('id' => Yii::app()->user->id)); ?>">
                    <p><?php echo Yii::app()->user->fullName; ?></p>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
            <?php $this->renderModuleMenu(); ?>
        </ul>
    </div>
</aside>