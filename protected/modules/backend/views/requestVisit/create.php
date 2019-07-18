<?php
/* @var $this RequestVisitController */
/* @var $model RequestVisit */

$this->breadcrumbs=array(
	'Request Visits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RequestVisit', 'url'=>array('index')),
	array('label'=>'Manage RequestVisit', 'url'=>array('admin')),
);
?>

<h1>Create RequestVisit</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>