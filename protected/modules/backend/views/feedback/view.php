<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->title = 'Вопрос: '.$model->subject;
$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Создать вопрос', 'url'=>array('create')),
	array('label'=>'Изменить вопрос', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить вопрос', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление вопросами', 'url'=>array('admin')),
);
?>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'email',
		'subject',
		'message',
        array(
            'name'=>'status',
            'value'=>($model->status)?"Обработан":"Новый"
        ),
	),
)); ?>
