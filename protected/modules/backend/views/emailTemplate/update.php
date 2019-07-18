<?php
/* @var $this EmailTemplateController */
/* @var $model EmailTemplate */
$this->title = Yii::t('BackendModule.backend', 'Редактирование шаблона').': '.$model->name;
$this->breadcrumbs=array(
	'Email Templates'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Шаблоны писем'), 'url'=>array('admin')),
	array('label'=>Yii::t('BackendModule.backend', 'Добавить шаблон'), 'url'=>array('create')),
	array('label'=>Yii::t('BackendModule.backend', 'Просмотр шаблона'), 'url'=>array('view', 'id'=>$model->id)),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>