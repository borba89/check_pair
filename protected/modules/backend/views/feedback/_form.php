<?php
/* @var $this FeedbackController */
/* @var $model Feedback */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'feedback-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model,'name',array('size'=>60,'maxlength'=>255)); ?>

    <?php echo $form->textFieldGroup($model,'email',array('size'=>60,'maxlength'=>255)); ?>

    <?php echo $form->textFieldGroup($model,'subject',array('rows'=>6, 'cols'=>50)); ?>


	<div class="row">
		<?php //echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textAreaGroup($model,'message',array('rows'=>12, 'cols'=>100)); ?>
		<?php //echo $form->error($model,'message'); ?>
	</div>

    <?php echo $form->dropDownList($model,'status', array(0=>'Новый', 1=>'Обработан')); ?>


    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-primary'),
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->