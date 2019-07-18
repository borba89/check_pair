<?php
/* @var $this DistrictController */
/* @var $model CityDistrict */

$this->title = 'Update CityDistrict '.$model->district_ru;

$this->breadcrumbs=array(
	'City Districts'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create CityDistrict', 'url'=>array('create')),
	array('label'=>'Manage CityDistrict', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>