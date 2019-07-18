<?php
/**
 * @var $model Entity
 * @var $attribute string
 * @var $htmlOptions array
 */
?>
<div class="form-group" id="compatible">
    <?php echo CHtml::activeLabelEx($model, $attribute, array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-sm-6">
        <?php echo CHtml::activeDropDownList($model, $attribute, $model->allTags, array('class'=>'form-control', 'multiple' => 'multiple')); ?>
	</div>
</div>

<?php
    $id = CHtml::activeId($model, $attribute);
    Yii::app()->clientScript->registerScript($id, "
        $('#{$id}').select2({
             tags: true,
             placeholder: 'Insert the tag',
             ajax: {
                url: '/backend/".Yii::app()->controller->id."/ajaxTags',
                dataType: 'json',
                quietMillis: 100,
             },
        });
    ");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule('backend')->assetsUrl.'/widgets/dist/js/select2.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerCssFile(Yii::app()->getModule('backend')->assetsUrl.'/widgets/dist/css/select2.min.css');
    Yii::app()->clientScript->registerCss('tags_custom', "
        .select2-selection__rendered input[type='search'] {box-shadow: none; height: 25px; padding: 0;}
    ");
?>