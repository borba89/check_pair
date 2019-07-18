<?php
    $this->title = 'Home Settings Update';
    $this->breadcrumbs=array(
        'Home Settings',
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'group' => $group)); ?>