<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'owner_name'); */?>
		<?php /*echo $form->textField($model,'owner_name',array('size'=>60,'maxlength'=>64)); */?>
		<?php /*echo $form->error($model,'owner_name'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'owner_id'); */?>
		<?php /*echo $form->textField($model,'owner_id'); */?>
		<?php /*echo $form->error($model,'owner_id'); */?>
	</div>-->

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'parent_id'); */?>
		<?php /*echo $form->textField($model,'parent_id'); */?>
		<?php /*echo $form->error($model,'parent_id'); */?>
	</div>-->

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'creator_id'); */?>
		<?php /*echo $form->textField($model,'creator_id'); */?>
		<?php /*echo $form->error($model,'creator_id'); */?>
	</div>-->

    <?php if($model->creator_id):?>
        <h5><?php echo $model->user->name;?></h5>
        <br><br><br>
    <?php else:?>
	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>
    <?php endif;?>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_text'); ?>
		<?php echo $form->textArea($model,'comment_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment_text'); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'create_time'); */?>
		<?php /*echo $form->textField($model,'create_time'); */?>
		<?php /*echo $form->error($model,'create_time'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'update_time'); */?>
		<?php /*echo $form->textField($model,'update_time'); */?>
		<?php /*echo $form->error($model,'update_time'); */?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatuses()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-primary'),
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->