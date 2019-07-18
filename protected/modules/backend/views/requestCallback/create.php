<?php
/* @var $this RequestCallbackController */
/* @var $model RequestCallback */
$this->title = Yii::t('BackendModule.backend', 'Добавить заказанный звонок');
$this->breadcrumbs=array(
	'Request Callbacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Звонки'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>