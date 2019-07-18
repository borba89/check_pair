<?php
    $this->title = 'Update Landing Setting';
    $this->breadcrumbs=array(
        'Landing Settings',
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>