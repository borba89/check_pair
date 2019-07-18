<?php

$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);

$this->title = 'Районы';

$this->menu=array(
    array('label'=>'Добавить район','url'=>array('create')),
);

$this->breadcrumbs=array(
	'Районы'=>array('admin'),
	'Все районы',
);
?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'city-district-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array(
            'name'=>'city_id',
            'value'=>'($data->city_id)?$data->city->city_name_ru:"Нет"'
        ),
		'district_en',
		'district_ru',
		'district_ro',
        array(
            'name'=>'suburb',
            'value'=>'($data->suburb)?"Да":"Нет"'
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '80px'),
            'template'=>'{update} {delete}'
        ),
	),
)); ?>
