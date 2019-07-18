<?php
	$this->breadcrumbs=array(
        'Blog Articles'=>array('admin'),
        $model->id=>array('view','id'=>$model->id),
        'Update',
    );

    $this->title = "Правка: ".Realty::model()->getRealtyType($model->type).', '.$model->addressTable->search_string;
?>

<?php echo $this->renderPartial('wizard', array('model'=>$model, 'address' => $address, 'realtyDetailed' => $realtyDetailed)); ?>