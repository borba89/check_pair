<?php
/* @var $this RequestCallbackController */
/* @var $model RequestCallback */
$this->title = Yii::t('BackendModule.backend', 'Заказанный звонок').': '.$model->name;
$this->breadcrumbs=array(
	'Request Callbacks'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>Yii::t('BackendModule.backend', 'Создать'), 'url'=>array('create')),
	//array('label'=>Yii::t('BackendModule.backend', 'Редактировать'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('BackendModule.backend', 'Удалить'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('BackendModule.backend', 'Звонки'), 'url'=>array('admin')),
);
?>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'created_at',
		'name',
		'phone',
		'comment',

	),
)); ?>
