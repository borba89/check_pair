<?php
/* @var $this RequestVisitController */
/* @var $model RequestVisit */

$this->breadcrumbs=array(
	'Request Visits'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RequestVisit', 'url'=>array('index')),
	array('label'=>'Create RequestVisit', 'url'=>array('create')),
	array('label'=>'View RequestVisit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RequestVisit', 'url'=>array('admin')),
);
?>

<h1>Update RequestVisit <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>