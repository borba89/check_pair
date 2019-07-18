<?php
	$this->breadcrumbs=array(
        'Realty Offers'=>array('admin'),
        'Create',
    );

    $this->menu=array(
    );
    $this->title = "Новое объявление";
?>

<?php echo $this->renderPartial('wizard', array(
    'model'=>$model,
    'realty' => $realty,
    'videos'=>$videos
)); ?>