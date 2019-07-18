<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'id',array('class'=>'form-control')); ?>

		<?php echo $form->textFieldGroup($model,'realty_id',array('class'=>'form-control')); ?>

		<?php echo $form->textFieldGroup($model,'type',array('class'=>'form-control','maxlength'=>4)); ?>

		<?php echo $form->textFieldGroup($model,'bid_type',array('class'=>'form-control','maxlength'=>9)); ?>

		<?php echo $form->textFieldGroup($model,'ammount',array('class'=>'form-control')); ?>

		<?php echo $form->textFieldGroup($model,'currency',array('class'=>'form-control','maxlength'=>4)); ?>

		<?php echo $form->textFieldGroup($model,'title',array('class'=>'form-control','maxlength'=>255)); ?>

		<?php echo $form->textAreaGroup($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
