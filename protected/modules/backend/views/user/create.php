<?php
    $this->title = 'Новый сотрудник';
    $this->breadcrumbs=array(
        'Users'=>array('admin'),
        'Create',
    );
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'phones'=>$phones)); ?>
