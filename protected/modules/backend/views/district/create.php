<?php
/* @var $this DistrictController */
/* @var $model CityDistrict */

$this->title = 'Create CityDistrict';

$this->breadcrumbs=array(
	'City Districts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage CityDistrict', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>