<?php
	$this->breadcrumbs=array(
        'Blog Articles'=>array('admin'),
        'Create',
    );
    $this->title = "Создать объект недвижимости";
?>

<?php echo $this->renderPartial('wizard', array('model'=>$model, 'address' => $address, 'realtyDetailed' => $realtyDetailed)); ?>