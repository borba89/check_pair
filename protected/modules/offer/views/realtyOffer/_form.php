<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'realty-offer-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('class' =>'form-horizontal row-border'),
)); ?>

    <?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'realty_id',array('class'=>'form-control')); ?>

	<?php echo $form->textFieldGroup($model,'type',array('class'=>'form-control','maxlength'=>4)); ?>

	<?php echo $form->textFieldGroup($model,'bid_type',array('class'=>'form-control','maxlength'=>9)); ?>

	<?php echo $form->textFieldGroup($model,'ammount',array('class'=>'form-control')); ?>

	<?php echo $form->textFieldGroup($model,'currency',array('class'=>'form-control','maxlength'=>4)); ?>

	<?php echo $form->textFieldGroup($model,'title',array('class'=>'form-control','maxlength'=>255)); ?>

	<?php echo $form->textAreaGroup($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>


    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'btn btn-primary'),
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>

<?php $this->endWidget(); ?>
