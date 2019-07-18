<?php
/* @var $this CategoryController */
/* @var $model ArticleCategory */
$this->title = "Создание категории блога";

$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);
$this->breadcrumbs=array(
	'Категории'=>array('admin'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Управление категориями', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>