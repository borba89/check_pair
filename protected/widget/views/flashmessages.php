<?php foreach(Yii::app()->user->getFlashes() as $key => $message) { ?>
    <?php if(strpos($key, 'success') !== false) { ?>
        <div class="modal fade" id="notify">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo Yii::t("base", "Notify");?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert"><?php echo $message; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php Yii::app()->clientScript->registerScript('popoverActivate',"$('#notify').modal('show');"); ?>
    <?php } ?>
<?php } ?>