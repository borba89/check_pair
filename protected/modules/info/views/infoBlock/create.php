<?php
$this->title = 'Новая услуга';
$this->breadcrumbs=array(
    'Users'=>array('admin'),
    'Create',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
