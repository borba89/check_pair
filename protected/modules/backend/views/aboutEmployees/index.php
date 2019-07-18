<?php
/* @var $this AboutEmployeesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'About Employees',
);

$this->menu=array(
	array('label'=>'Create AboutEmployees', 'url'=>array('create')),
	array('label'=>'Manage AboutEmployees', 'url'=>array('admin')),
);
?>

<h1>About Employees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
