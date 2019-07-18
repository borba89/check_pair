<?php
/* @var $this AuctionController */
/* @var $model Auction */
$this->title = Yii::t('BackendModule.backend', 'Продолжить создание аукциона');
$this->breadcrumbs=array(
	'Auctions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'Создать аукцион', 'url'=>array('create')),
	array('label'=>'Аукционы', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>