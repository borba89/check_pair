<div class="heading clearfix">
    <h3 class="pull-left"><?php echo Yii::t("main", "Фотографии"); ?></h3>
</div>
<div class="control-group "><label class="control-label">&nbsp;</label>
    <div class="controls">
        <div class="wmk_grid">
            <?php if ($tempId) { ?>
                <?php
                    $tCriteria = new CDbCriteria();
                    $tCriteria->condition = 'item_id = :item_realty && content_type = "realty"';
                    $tCriteria->addCondition('item_id = :item_offer && content_type = "realtyoffer"', 'OR');
                    $tCriteria->params[':item_realty'] = $realty_id;
                    $tCriteria->params[':item_offer'] = $tempId;
                    $images = MultipleImages::model()->findAll($tCriteria);

                    if ($images) {
                        foreach ($images as $image) {
                            echo $this->renderPartial("application.modules.backend.views.multiapload._image", array('image'=>$image));
                        }
                    }
                ?>
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