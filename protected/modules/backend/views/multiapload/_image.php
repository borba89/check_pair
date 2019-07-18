<div data-id="<?php echo $image->id; ?>" class="col s12 m12 l4 element">
    <div class="thumbnail-box <?php echo ($image->is_main ? "active" : "")?>">
        <a id="<?php echo $image->id; ?>" title="" href="#" class="thumb-link delete"></a>
        <div class="thumb-content">
            <div class="center-vertical">
                <div class="center-content">
                    <i class="icon-helper icon-center animated fadeIn font-white glyph-icon icon-linecons-search"></i>
                </div>
            </div>
            <?php if($this->action->id != 'view') { ?>
                <a href="javascript:void(0)" title="Set Main" class="main" id="<?php echo $image->id; ?>">
                    <i class="material-icons dp48" id="<?php echo $image->id; ?>">done</i>
                </a>
                <a href="javascript:void(0)" title="Remove" class="delete" id="<?php echo $image->id; ?>">
                    <i class="material-icons dp48">delete</i>
                </a>
            <?php } ?>
		</div>
        <div class="thumb-overlay bg-black"></div>
        <?php if (0) : ?>
<!--        <a rel="group1" href="--><?php //Yii::app()->iwi->load($image->path)->adaptive(600, 480)->quality(75)->cache(); ?><!--" class="images-group">-->
<!--            <img alt="" src="--><?php //echo Yii::app()->iwi->load($image->path)->adaptive(358, 268)->quality(75)->cache(); ?><!--">-->
<!--        </a>-->
        <?php endif; ?>
        <img alt="" src="<?php echo Yii::app()->iwi->load($image->path)->adaptive(358, 268)->quality(75)->cache(); ?>">

    </div>
</div>