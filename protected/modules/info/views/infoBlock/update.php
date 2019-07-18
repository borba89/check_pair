<?php
$this->title = 'Услуга: "'.$model->title.'"';
$this->breadcrumbs=array(
    'Users'=>array('admin'),
    'Update',
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>