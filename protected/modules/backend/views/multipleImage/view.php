<?php
    $this->title = 'View AlbumImage #'.$model->id;
    $this->breadcrumbs=array(
        'Album Images'=>array('admin'),
        $model->id,
    );

    $this->menu=array(
        array('label'=>'Create AlbumImage','url'=>array('create')),
        array('label'=>'Update AlbumImage','url'=>array('update','id'=>$model->id)),
        array('label'=>'Delete AlbumImage','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Manage AlbumImage','url'=>array('admin')),
    );
?>

<?php $this->widget('booster.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'item_id',
        'title_ro',
        'title_ru',
        'path:image',
        'author:user',
        'created:date'
    ),
)); ?>
