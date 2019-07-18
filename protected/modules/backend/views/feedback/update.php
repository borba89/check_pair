<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->title = 'Редактировать вопрос: '.$model->subject;
$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создать вопрос', 'url'=>array('create')),
	array('label'=>'Просмтотр', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление вопросами', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>