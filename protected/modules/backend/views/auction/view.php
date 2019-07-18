<?php
/* @var $this AuctionController */
/* @var $model Auction */
$this->title = Yii::t('BackendModule.backend', 'Просмотр аукциона');
$this->breadcrumbs=array(
	'Auctions'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'Создать аукцион', 'url'=>array('create')),
	array('label'=>'Редактировать аукцион', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить аукцион', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Аукционы', 'url'=>array('admin')),
);
?>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'offer_id',
            'value'=>$model->offer->{"title_".Yii::app()->language}
        ),
		'start_bids',
        array(
            'label'=>'Количество заявок',
            'value'=>$model->countBids
        ),
		'end_date',
        array(
            'name'=>'status',
            'value'=>($model->status)?"Да":"Нет"
        ),
	),
));
?>
<h4>Ставки</h4>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Пользователь</th>
        <th>Телефон</th>
        <th>Ставка</th>
        <th>Дата</th>
        <th>Статус</th>
    </tr>
	<?php foreach ($model->bids as $bid):?>
	<tr>
		<td><?php echo $bid->id;?></td>
		<!--<td><?php /*echo $bid->auction->offer->getTitle();*/?></td>-->
		<td><?php echo $bid->name;?></td>
		<td><?php echo $bid->phone;?></td>
		<td><?php echo $bid->bid;?> USD</td>
		<td><?php echo $bid->created_at;?></td>
		<td><?php echo $bid->status;?></td>
	</tr>
	<?php endforeach;?>
</table>
