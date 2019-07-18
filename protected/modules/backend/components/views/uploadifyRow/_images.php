<div class="heading clearfix">
    <h3 class="pull-left"><?php echo Yii::t("main", "Фотографии"); ?></h3>
</div>
<div class="control-group thumb-image">
    <label class="control-label">&nbsp;</label>
    <div class="controls">
        <div class="wmk_grid">
            <div class="row image_add">
                <?php
                    if ($model instanceof Realtyoffer) {
                        $images = $model->getUnitedImages();
                    } else {
                        $images = $model->$relation;
                    }
                ?>
                <?php if (count($images) > 0) { ?>
                    <?php foreach ($images as $image) { ?>
                        <div data-id="<?php echo $image->id; ?>" class="col s12 m12 l4 element">
                            <div class="thumbnail-box <?php echo ($image->is_main ? "active" : "")?>">
                                <a id="<?php echo $image->id; ?>" title="" href="#" class="thumb-link delete"></a>
                                <div class="thumb-content">
                                    <div class="center-vertical">
                                        <div class="center-content">
                                            <i class="icon-helper icon-center animated fadeIn font-white glyph-icon icon-linecons-search"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" title="Set Main" class="main" id="<?php echo $image->id; ?>">
                                        <i class="material-icons dp48" id="<?php echo $image->id; ?>">done</i>
                                    </a>
                                    <a href="javascript:void(0)" title="Remove" class="delete" id="<?php echo $image->id; ?>">
                                        <i class="material-icons dp48">delete</i>
                                    </a>
                                </div>
                                <div class="thumb-overlay bg-black"></div>
                                <?php if (0) : ?>
<!--                                <a rel="group1" href="--><?php //echo Yii::app()->iwi->load($image->$attribute)->adaptive(600, 480)->cache(); ?><!--" class="images-group">-->
<!--                                    <img alt="" src="--><?php //echo Yii::app()->iwi->load($image->$attribute)->adaptive(358, 268)->cache(); ?><!--">-->
<!--                                </a>-->
                                <?php endif; ?>
                                <img alt="" src="<?php echo Yii::app()->iwi->load($image->$attribute)->adaptive(358, 268)->cache(); ?>">
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">?</button>
                    There is no images. Click <strong>Select files</strong> to upload images.
                </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>