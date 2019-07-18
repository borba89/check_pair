<?php
/* @var $this AboutEmployeesController */
/* @var $model AboutEmployees */
$this->title = Yii::t('BackendModule.backend', 'Редактирование блока').' '.$model->id;
$this->breadcrumbs=array(
	'About Employees'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Добавить блок', 'url'=>array('create')),
	//array('label'=>'View AboutEmployees', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление блоками', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>