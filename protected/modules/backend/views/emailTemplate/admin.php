<?php
/* @var $this EmailTemplateController */
/* @var $model EmailTemplate */
$this->title = Yii::t('BackendModule.backend', 'Шаблоны писем');
$this->breadcrumbs=array(
	'Email Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Шаблоны писем'), 'url'=>array('admin')),
	array('label'=>Yii::t('BackendModule.backend', 'Добавить шаблон'), 'url'=>array('create')),
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'email-template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		//'variables',
		'subject_ru',
		'subject_ro',
		'subject_en',
        array(
        	'header'=>Yii::t('BackendModule.backend', 'Статус'),
            'name'=>'status',
            'value'=>'($data->status)?"Вкл":"Выкл"'
        ),
		/*
		'message_ru',
		'message_ro',
		'message_en',
		'status',
		*/
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px'),
            'template'=>'{view} {update} {delete}'
        ),
	),
)); ?>
