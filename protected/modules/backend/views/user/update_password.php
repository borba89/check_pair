<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Manage User','url'=>array('admin')),
);
$this->title = 'New password for "'.$model->fullName.'"';
?>

<?php echo $this->renderPartial('_form_password',array('model'=>$model)); ?>