<?php
/* @var $this DistrictController */
/* @var $model CityDistrict */

$this->breadcrumbs=array(
	'City Districts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CityDistrict', 'url'=>array('index')),
	array('label'=>'Create CityDistrict', 'url'=>array('create')),
	array('label'=>'Update CityDistrict', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CityDistrict', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CityDistrict', 'url'=>array('admin')),
);
?>

<h1>View CityDistrict #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'city_id',
		'district_en',
		'district_ru',
		'district_ro',
		'suburb',
	),
)); ?>
