<?php
$attributeClean = preg_replace('~^\[[0-9]+\]~', '', $attribute);
$id = CHtml::activeId($model, $attribute).rand(1,10000).uniqid();
?>

<div data-provides="fileinput" class="fileinput fileinput-new input-group">
    <input id="<?php echo $id; ?>" type="file" data-show-cancel="false" data-show-upload="false" data-show-caption="true" name="<?php echo CHtml::activeName($model, $attribute) ?>">
    <?php echo CHtml::activeHiddenField($model, $attribute."_remove", array('value'=>0)); ?>
</div>

<?php
$type = 'image';
$initial = null;

Yii::app()->clientScript->registerScript('remove_kartik_file_'.$id,'
    $("#'. $id.'").on("fileclear", function(event) {
	    $("#'. CHtml::activeId($model, $attribute).'_remove").val(1);
	});
	$("#'. $id.'").on("fileloaded", function(event) {
	    $("#'. CHtml::activeId($model, $attribute).'_remove").val(0);
	});
', CClientScript::POS_READY);

if (!empty($model->$attributeClean)) {
    $path_info = pathinfo($model->$attributeClean);
    if (!empty($model->$attributeClean) && $path_info['extension'] == 'gif') {
        $initial = CHtml::image('/'.$model->$attributeClean, 'image', array('width' => 510));
    } elseif (in_array($path_info['extension'], array('aac', 'ogg', 'mp3', 'vav'))) {
        $type = 'audio';
        $initial = '<div class=\'file-preview-text\'><i class=\'fa fa-file-audio-o text-warning\'></i></div>';
    } elseif (!empty($model->$attributeClean) && $path_info['extension'] != 'swf') {
        $initial = CHtml::image(Yii::app()->iwi->load($model->$attributeClean)->cache(), 'image', array('class' => 'file-preview-image'));
    } elseif (!empty($model->$attributeClean) && $path_info['extension'] == 'swf') {$type = 'swf'; ob_start(); ?>
        <div class='file-preview-frame'>
            <object
                classid="clsid:D697CDE7E-AE6D-11cf-96B8-458453540000"
                codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0"
                id="animation name">

                <param name="movie" value="<?php echo Yii::app()->request->baseUrl .'/'. $model->$attributeClean; ?>">
                <param name="quality" value="high">
                <param name="bgcolor" value="#FFFFFF">

                <embed
                    name="animationname"
                    src="<?php echo Yii::app()->request->baseUrl .'/'. $model->$attributeClean; ?>"
                    width="100%"
                    quality="high"
                    bgcolor="#FFFFFF"
                    type="application/x-shockwave-flash"
                    pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
                </embed>
            </object>
        </div>
        <?php $initial = ob_get_clean(); ?>
    <?php } ?>
<?php } ?>

<?php
if ($type == 'swf' && empty($initial))
    $initialPreview = "<div class='file-preview-text'>" +
        "<h2><i class='glyphicon glyphicon-file'></i></h2>" +
        "Filename.xlsx" + "</div>";
elseif ($type == 'audio')
    $initialPreview = '"'.$initial.'"';
elseif ($type == 'image' && !empty($initial))
    $initialPreview = "['".addslashes(trim($initial))."']";
else
    $initialPreview = '""';
?>

<?php Yii::app()->clientScript->registerScript('fileField'.$id,"
    $('#$id').fileinput({
        initialPreview: ".$initialPreview.",
        overwriteInitial: true,
        language: '".Yii::app()->language."',
    });
", CClientScript::POS_READY); ?>
