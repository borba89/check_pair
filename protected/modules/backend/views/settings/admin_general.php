<?php
    $this->title = 'Manage General Settings';
    $this->breadcrumbs=array(
        'General Settings'=>array('admin', 'id' => Settings::GENERAL),
        'Manage',
    );
$this->menu=array(
    array('label'=>'Create General Setting','url'=>array('create')),
);
?>

<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'settings-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(Settings::GENERAL),
	'filter'=>null,
    'htmlOptions'=>array('style'=>'padding:0;'),
	'columns'=>array(
        array('name'=>'id','headerHtmlOptions'=>array('width'=>'40px')),
        'category',
		'key',
        array(
        	'name'=>'value',
			'value'=>'Yii::app()->settings->get($data->category, $data->key)'
		),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template'=>'{view} {update}'
        ),
	),
)); ?>
