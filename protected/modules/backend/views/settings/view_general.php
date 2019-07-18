<?php
    $this->title = 'View Setting #'.$model->id;;
    $this->menu=array(
        array('label'=>'Update Setting','url'=>array('update','id'=>$model->id)),
        array('label'=>'Manage Settings','url'=>array('admin', 'id' => Settings::GENERAL)),
    );
    $this->breadcrumbs=array(
        'Manage Settings'=>array('admin', 'id' => Settings::CUSTOM),
        $model->id,
    );
?>

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'name',
        'description',
        $model->type == Settings::IMAGE ? 'value:image' : 'value',
        'type',
	),
)); ?>
