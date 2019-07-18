<?php
/* @var $this AboutEmployeesController */
/* @var $model AboutEmployees */
$this->title = 'Просмотр блока #'.$model->id;
$this->breadcrumbs=array(
	'About Employees'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Добавить блок', 'url'=>array('create')),
	array('label'=>'Редактировать блок', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить блок', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление блоками', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-lg-12 company_description">
		<img class="agent_img" src="/<?php echo $model->image;?>" width="255" style="float:left;margin-right: 20px;">
		<h3><?php echo $model->getTitle();?></h3>
		<p class="description_block" style="color: gray;">
            <?php echo $model->getSubtitle();?>
			<br/>
            <?php echo $model->getText();?>
		</p>
	</div>
</div>
