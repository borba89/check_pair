<?php
/* @var $this EmailTemplateController */
/* @var $model EmailTemplate */
$this->title = Yii::t('BackendModule.backend', 'Создание нового шаблона');
$this->breadcrumbs=array(
	'Email Templates'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Шаблоны писем'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>