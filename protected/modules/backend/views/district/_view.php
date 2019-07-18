<?php
/* @var $this DistrictController */
/* @var $data CityDistrict */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district_en')); ?>:</b>
	<?php echo CHtml::encode($data->district_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district_ru')); ?>:</b>
	<?php echo CHtml::encode($data->district_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district_ro')); ?>:</b>
	<?php echo CHtml::encode($data->district_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suburb')); ?>:</b>
	<?php echo CHtml::encode($data->suburb); ?>
	<br />


</div>