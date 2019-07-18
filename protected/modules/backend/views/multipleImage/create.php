<?php
    $this->title = 'Create Image';
    $this->menu=array(
        array('label'=>'Manage Image','url'=>array('admin')),
    );
    $this->breadcrumbs=array(
        'Manage Image'=>array('admin'),
        'Create',
    );
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
