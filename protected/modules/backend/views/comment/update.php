<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->title = Yii::t('BackendModule.backend', 'Редактирование комментария');
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Управление комментариями'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>