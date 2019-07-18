<?php
/* @var $this RequestCallbackController */
/* @var $model RequestCallback */
$this->title = Yii::t('BackendModule.backend', 'Звонки');
$this->breadcrumbs=array(
    Yii::t('BackendModule.backend', 'Звонки')=>array('admin'),
    Yii::t('BackendModule.backend', 'Управление'),
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Звонки'), 'url'=>array('admin')),
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'request-callback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'created_at',
		'name',
		'phone',
		/*array(
			'name'=>'comment',
			'value'=>'YText::characterLimiter($data->comment, 40)'
		),*/
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px'),
            'template'=>'{view} '
        ),
	),
)); ?>
