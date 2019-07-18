<?php
/* @var $this VacancyController */
/* @var $model Vacancy */
$this->title = Yii::t('BackendModule.backend','Управление вакансиями');
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);

$this->breadcrumbs=array(
	'Vacancies'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Назад', 'url'=>array('/offer/realtyOffer/admin')),
	array('label'=>'Создать вакансию', 'url'=>array('create')),
);

?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'vacancy-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
            'htmlOptions' => array('width' => '80px'),
            'template'=>'{update} {delete}'
        ),
	),
)); ?>
