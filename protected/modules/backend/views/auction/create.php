<?php
/* @var $this AuctionController */
/* @var $model Auction */

$this->title = Yii::t('BackendModule.backend', 'Создание аукциона');

$this->breadcrumbs=array(
	'Auctions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Auction', 'url'=>array('index')),
	array('label'=>'Manage Auction', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>