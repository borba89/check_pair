<?php
/* @var $this AboutEmployeesController */
/* @var $model AboutEmployees */
$this->title = Yii::t('BackendModule.backend', 'Блоки страницы О компании');
$this->breadcrumbs=array(
	'About Employees'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Управление блоками', 'url'=>array('admin')),
	array('label'=>'Добавить блок на страницу', 'url'=>array('create')),
);

?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'about-employees-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'title_en',
		'title_ro',
		'title_ru',
		//'subtitle_en',
		//'subtitle_ro',
		/*
		'subtitle_ru',
		'text_en',
		'text_ro',
		'text_ru',
		'image',
		*/
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '100px'),
            'template'=>'{view} {update} {delete}'
        ),
	),
)); ?>
