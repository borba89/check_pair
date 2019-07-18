<?php
/* @var $this RequestVisitController */
/* @var $model RequestVisit */
Yii::import('realty.models.*');
$this->title = Yii::t('BackendModule.backend', 'Заказы осмотров');
$this->breadcrumbs=array(
	'Request Visits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Заказы осмотров'), 'url'=>array('admin')),
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'request-visit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'created_at',
		array(
		    'name'=>'realty_id',
            'value'=>'CHtml::link($data->realty->getUrl(), $data->realty->getUrl(), array("target"=>"_blank"))',
			'type'=>'raw'
        ),
		'name',
		'phone',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px'),
            'template'=>'{view} '
        ),
	),
)); ?>
