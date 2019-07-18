<?php
/* @var $this ContentBlockController */
/* @var $model ContentBlock */

$this->breadcrumbs=array(
	'Content Blocks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create ContentBlock', 'url'=>array('create')),
	array('label'=>'Update ContentBlock', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ContentBlock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContentBlock', 'url'=>array('admin')),
);
?>

<h1>View ContentBlock #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'name',
		'description',
		'code',
		'type',
		'title_en',
		'title_ro',
		'title_ru',
		'content_en',
		'content_ro',
		'content_ru',
	),
)); ?>
