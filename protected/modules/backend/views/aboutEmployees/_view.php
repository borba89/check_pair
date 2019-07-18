<?php
/* @var $this AboutEmployeesController */
/* @var $data AboutEmployees */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_en')); ?>:</b>
	<?php echo CHtml::encode($data->title_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ro')); ?>:</b>
	<?php echo CHtml::encode($data->title_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ru')); ?>:</b>
	<?php echo CHtml::encode($data->title_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitle_en')); ?>:</b>
	<?php echo CHtml::encode($data->subtitle_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitle_ro')); ?>:</b>
	<?php echo CHtml::encode($data->subtitle_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitle_ru')); ?>:</b>
	<?php echo CHtml::encode($data->subtitle_ru); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('text_en')); ?>:</b>
	<?php echo CHtml::encode($data->text_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_ro')); ?>:</b>
	<?php echo CHtml::encode($data->text_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_ru')); ?>:</b>
	<?php echo CHtml::encode($data->text_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	*/ ?>

</div>