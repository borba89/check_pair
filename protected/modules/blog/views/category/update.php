<?php
/* @var $this CategoryController */
/* @var $model ArticleCategory */
$this->title = "Редактирование категории блога";

$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);

$this->breadcrumbs=array(
	'Категории'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создать категорию', 'url'=>array('create')),
	array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление категориями', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>