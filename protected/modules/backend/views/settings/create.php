<?php
    $this->title = 'Create Setting';
    $this->menu=array(
        array('label'=>'Manage General Settings','url'=>array('admin', 'id' => Settings::GENERAL)),
    );
    $this->breadcrumbs=array(
        'General Settings'=>array('admin', 'id' => Settings::GENERAL),
        'Create',
    );
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>