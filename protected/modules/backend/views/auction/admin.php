<?php
/* @var $this AuctionController */
/* @var $model Auction */
$this->title = Yii::t('BackendModule.backend', 'Управление аукционами');
$this->breadcrumbs=array(
	'Auctions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Аукционы', 'url'=>array('admin')),
	//array('label'=>'Создать аукцион', 'url'=>array('create')),
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'auction-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		array(
		    'name'=>'offer_id',
		    'value'=>'$data->offer->{"title_".Yii::app()->language}'
        ),
		'start_bids',
        array(
            'header'=>'Количество заявок',
            'value'=>'$data->countBids'
        ),
		'end_date',
        array(
            'name'=>'status',
            'value'=>'($data->status)?"Да":"Нет"'
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px'),
            'template'=>'{view} {update} {delete}'
        ),
	),
)); ?>
