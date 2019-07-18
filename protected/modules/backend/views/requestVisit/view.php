<?php
/* @var $this RequestVisitController */
/* @var $model RequestVisit */
Yii::import('realty.models.*');
$this->title = Yii::t('BackendModule.backend', 'Заказ осмотра');
$this->breadcrumbs=array(
	'Request Visits'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Удалить'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('BackendModule.backend', 'Заказы осмотров'), 'url'=>array('admin')),
);
?>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'created_at',
        array(
            'name'=>'realty_id',
            'value'=>CHtml::link($model->realty->getUrl(), $model->realty->getUrl(), array("target"=>"_blank")),
            'type'=>'raw'
        ),
		'name',
		'phone',
		'email',
		'message',
	),
)); ?>
