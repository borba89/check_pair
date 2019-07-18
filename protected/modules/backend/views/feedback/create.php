<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->title = 'Создать вопрос';
$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление вопросами', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>