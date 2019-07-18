<?php $this->beginContent(Yii::app()->getModule('backend')->getBackendLayoutAlias('main')); ?>
<div class="row">
    <div class="col s12">
        <div class="right-align">
            <?php $this->widget('ExtendedMenu', array(
                'menuModel' => $this->menuModel,
                'activeAddress' => $this->activeAddress,
                'items' => $this->menu,
            )); ?>
        </div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
