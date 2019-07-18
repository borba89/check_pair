<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
$this->title = Yii::t('BackendModule.backend', 'Добавление подписчика');
$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Подписчики'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>