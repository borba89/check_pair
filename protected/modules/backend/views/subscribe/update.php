<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
$this->title = Yii::t('BackendModule.backend', 'Редактирование данных подписчика');
$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Добавить подписчика'), 'url'=>array('create')),
    array('label'=>Yii::t('BackendModule.backend', 'Подписчики'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>