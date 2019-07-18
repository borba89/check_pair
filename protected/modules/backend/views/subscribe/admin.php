<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
$this->title = Yii::t('BackendModule.backend', 'Подписчики');
$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Подписчики'), 'url'=>array('admin')),
	array('label'=>Yii::t('BackendModule.backend', 'Добавить подписчика'), 'url'=>array('create')),
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'subscribe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'email',
		'created_at',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px'),
            'template'=>'{update} {delete}'
        ),
	),
)); ?>
