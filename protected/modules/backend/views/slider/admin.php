<?php
/* @var $this SliderController */
/* @var $model Slider */
$this->title = Yii::t('BackendModule.backend', 'Слайдер на стартовой');
$this->breadcrumbs=array(
    Yii::t('BackendModule.backend', 'Слайдер')=>array('admin'),
	Yii::t('BackendModule.backend', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Добавить слайд'), 'url'=>array('create')),
	array('label'=>Yii::t('BackendModule.backend', 'Назад'), 'url'=>array('/backend/settings/pages', 'active_tab'=> 'tab1')),
);

?>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
	<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings') ?>"><?php echo Yii::t('BackendModule.backend', 'Настройки')?></a></li>
	<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages') ?>"><?php echo Yii::t('BackendModule.backend', 'Страницы-сайта')?></a></li>
	<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages', ['active_tab'=> 'tab1']) ?>"><?php echo Yii::t('BackendModule.backend', 'Стартовая')?></a></li>
	<li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Слайдер')?></li>
</ol>

<div class="grid-view-filter-custom">
<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'slider-grid',
    'template' => '{items} {pager}',
    //    'ajaxUpdate'=>false,
    'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        [
            'name' => 'id',
            'htmlOptions' => ['width' => '60px', 'style'=>'text-align:center;'],
            'headerHtmlOptions'=>[
                'width' => '60px',
                'style'=>'text-align:center;'
            ],
        ],
		'title_ru',
        'title_ro',
        'title_en',
        //'subtitle_en',
		//'subtitle_ro',
		//'subtitle_ru',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '70px'),
            'template'=>'{update} {delete}'
        ),
	),
)); ?>
</div>