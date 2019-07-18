<?php $id = CHtml::activeId($model, $attribute); ?>
<div id="<?php echo $id; ?>">
    <?php $this->render("uploadifyRow/_images", array('model' => $model, "attribute" => $attribute,'relation'=>$relation)); ?>
</div>

<div class="control-group ">
    <label class="control-label">&nbsp;</label>
    <div class="controls">
        <div class="fupload">
            <div id="queue"></div>
            <input id="file_upload-<?php echo $id; ?>" type="file" name="Filedata" style="display: none; " width="120"
                   height="30">
        </div>
    </div>
</div>

<?php Yii::app()->clientScript->registerScript('multiple_functions',"

    var timestamp = ".time()."
    var uploadify_id = '#file_upload-".$id."';
    var gallery_id = '#".$id."';

    $(uploadify_id).uploadifive({
        'auto'             : true,
        'fileType'         : 'image',
        'formData'         : {'id':'".$model->getTempId()."'},
        'queueID'          : 'queue',
        'removeCompleted'  : true,
        'uploadScript'     : '".Yii::app()->createUrl(Yii::app()->controller->module->id . "/" . lcfirst(get_class($model)) . "/upload")."',
        'onUploadComplete' : function () {
            // after successfully save refresh gallery
            $.ajax({
                type:'POST',
                data:{id:'".$model->getTempId()."', realty_id: $('#RealtyOffer_realty_id').val()},
                url:'".Yii::app()->createUrl(Yii::app()->controller->module->id . "/" . lcfirst(get_class($model)) . "/gallery")."',
                success:function (output) {
                    $(gallery_id).html(output);
                    sortable_realtyOffer();
                }
            });
        },
        // if error get it in console

        'onError':function (event, ID, fileObj, errorObj) {
            console.log(errorObj.type + ' Error: ' + errorObj.info);
        },
    });

    // common delete ajax method of images

    $(gallery_id).on('click', '.delete', function () {
        var self = $(this);
        $.ajax({
            type:'POST',
            data:{id:self.attr('id')},
            url:'".Yii::app()->createUrl(Yii::app()->controller->module->id . "/" . lcfirst(get_class($model)) . "/imagedel")."',
            success:function (msg) {
               self.closest('.element').fadeOut();
            }
        });
    });

    $(gallery_id).on('click', '.main', function () {
        var self = $(this);
        $('.main').toggleClass('active');
        $.ajax({
            type:'POST',
            data:{id:this.id, offer_id:'".$model->getTempId()."'},
            url:'".Yii::app()->createUrl(Yii::app()->controller->module->id . "/" . lcfirst(get_class($model)) . "/mainimage")."',
            success:function (data) {
            if(data) {
                $('.thumbnail-box').removeClass('active');
                self.closest('.thumbnail-box').toggleClass('active');
            }
        },
        error:function(data){
            console.log(data);
        }
        });
    });
    
", CClientScript::POS_READY); ?>