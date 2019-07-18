<div class="heading clearfix">
    <h3 class="pull-left"><?php echo Yii::t("main", "Фотографии"); ?></h3>
</div>
<div class="control-group "><label class="control-label">&nbsp;</label>
    <div class="controls">
        <div class="wmk_grid">
            <!--                <div class="row">-->
            <div class="row image_add">
            <?php if ($model instanceof Realtyoffer) {
                $images = $model->getUnitedImages();
            } else {
                $images = $model->contypeImagesList;
            } ?>
            <?php if (count($images) > 0) { ?>
                    <?php foreach ($images as $image) {
                        echo $this->renderPartial("application.modules.backend.views.multiapload._image", array('image'=>$image));
                    } ?>
            <?php } else { ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    There is no images. Click <strong>Select files</strong> to upload images.
                </div>
            <?php } ?>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>