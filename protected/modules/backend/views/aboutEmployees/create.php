<?php
/* @var $this AboutEmployeesController */
/* @var $model AboutEmployees */
$this->title = Yii::t('BackendModule.backend', 'Добавление блока на страницу О компании');
$this->breadcrumbs=array(
	'About Employees'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управлние блоками', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>