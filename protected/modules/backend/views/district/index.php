<?php
/* @var $this DistrictController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'City Districts',
);

$this->menu=array(
	array('label'=>'Create CityDistrict', 'url'=>array('create')),
	array('label'=>'Manage CityDistrict', 'url'=>array('admin')),
);
?>

<h1>City Districts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
