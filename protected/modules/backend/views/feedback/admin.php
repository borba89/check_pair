<?php
/* @var $this FeedbackController */
/* @var $model Feedback */
$this->title = 'Вопросы';
$this->breadcrumbs=array(
	'Вопросы'=>array('admin'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Добавить вопрос', 'url'=>array('create')),
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'feedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        'subject',
		'name',
		'email',
		//'message',
        array(
        	'name'=>'status',
			'value'=>'($data->status)?"Обработан":"Новый"'
		),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px'),
            'template'=>'{view} {update} {delete}'
        ),
	),
)); ?>
