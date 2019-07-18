<?php
/* @var $this VacancyController */
/* @var $model Vacancy */

$this->breadcrumbs=array(
	'Vacancies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Vacancy', 'url'=>array('index')),
	array('label'=>'Create Vacancy', 'url'=>array('create')),
	array('label'=>'Update Vacancy', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Vacancy', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Vacancy', 'url'=>array('admin')),
);
?>

<h1>View Vacancy #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title_en',
		'title_ro',
		'title_ru',
		'subtitle_en',
		'subtitle_ro',
		'subtitle_ru',
		'text_en',
		'text_ro',
		'text_ru',
		'image',
	),
)); ?>
