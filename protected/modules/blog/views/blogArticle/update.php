<?php
	$this->breadcrumbs=array(
        'Статьи'=>array('admin'),
        $model->id=>array('view','id'=>$model->id),
        'Update',
    );

    $this->title = "Правка: ". $model->title;
?>

<?php echo $this->renderPartial('wizard', array('model'=>$model)); ?>