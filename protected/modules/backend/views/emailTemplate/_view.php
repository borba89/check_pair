<?php
/* @var $this EmailTemplateController */
/* @var $data EmailTemplate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('variables')); ?>:</b>
	<?php echo CHtml::encode($data->variables); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_ru')); ?>:</b>
	<?php echo CHtml::encode($data->subject_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_ro')); ?>:</b>
	<?php echo CHtml::encode($data->subject_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_en')); ?>:</b>
	<?php echo CHtml::encode($data->subject_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_ru')); ?>:</b>
	<?php echo CHtml::encode($data->message_ru); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('message_ro')); ?>:</b>
	<?php echo CHtml::encode($data->message_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_en')); ?>:</b>
	<?php echo CHtml::encode($data->message_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>