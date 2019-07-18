<?php
$this->breadcrumbs=array(
	'Album Images',
);

$this->menu=array(
	array('label'=>'Create AlbumImage','url'=>array('create')),
	array('label'=>'Manage AlbumImage','url'=>array('admin')),
);
?>

<legend>Album Images</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
