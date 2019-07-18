<?php
    $this->breadcrumbs=array(
        'Album Images'=>array('admin'),
        $model->id=>array('view','id'=>$model->id),
        'Update',
    );
    $this->menu=array(
        array('label'=>'Create AlbumImage','url'=>array('create')),
        array('label'=>'View AlbumImage','url'=>array('view','id'=>$model->id)),
        array('label'=>'Manage AlbumImage','url'=>array('admin')),
    );
    $this->title = "Update AlbumImage $model->id";
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>