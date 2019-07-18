<?php
/* @var $this RequestVisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Request Visits',
);

$this->menu=array(
	array('label'=>'Create RequestVisit', 'url'=>array('create')),
	array('label'=>'Manage RequestVisit', 'url'=>array('admin')),
);
?>

<h1>Request Visits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
