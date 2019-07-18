<?php
/* @var $this RequestCallbackController */
/* @var $model RequestCallback */
$this->title = Yii::t('BackendModule.backend', 'Редактировать заказанный звонок');
$this->breadcrumbs=array(
	'Request Callbacks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Звонки'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>