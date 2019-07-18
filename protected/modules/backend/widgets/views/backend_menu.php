<aside id="slide-out" class="side-nav white fixed">
    <div class="side-nav-wrapper">
        <div class="sidebar-profile">
            <div class="sidebar-profile-info">
                <a href="<?php echo Yii::app()->createUrl('/backend/user/view', array('id' => Yii::app()->user->id)); ?>">
                    <p><?php echo Yii::app()->user->fullName; ?></p>
                </a>
            </div>
        </div>
        <?php $this->widget('application.components.CmMenu', array(
                'htmlOptions' => array(
                    'class' => 'sidebar-menu collapsible collapsible-accordion',
                    'data-collapsible'=>'accordion'
                ),
                'items'=>$items
        )); ?>

        <?php /*$this->widget('application.extensions.mbmenu.MbMenu', array(
            'htmlOptions' => array(
                'class' => 'sidebar-menu collapsible collapsible-accordion',
                'data-collapsible'=>'accordion'
            ),
            'items'=>$items
        )); */?>
    </div>
</aside>