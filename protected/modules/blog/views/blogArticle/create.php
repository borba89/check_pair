<?php
	$this->breadcrumbs=array(
        'Blog Articles'=>array('admin'),
        'Create',
    );

    $this->title = "Новая статья";
?>

<?php echo $this->renderPartial('wizard', array('model'=>$model)); ?>