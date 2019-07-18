<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListGroup($model, "category", $model->getCategories(), array('class'=>'form-control','maxlength'=>1)); ?>
    <?php echo $form->textFieldGroup($model, "key", array('class'=>'form-control')); ?>
    <?php echo $form->textFieldGroup($model, "value", array('class'=>'form-control')); ?>

    <div class="clearfix"></div>

    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'btn btn-primary'),
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>

<?php $this->endWidget(); ?>