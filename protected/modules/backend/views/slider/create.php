<?php
/* @var $this SliderController */
/* @var $model Slider */
$this->title = Yii::t('BackendModule.backend', 'Добавление нового слайда на стартовую');
$this->breadcrumbs=array(
    Yii::t('BackendModule.backend', 'Слайдер')=>array('admin'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Отмена'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('/backend/slider/admin'),'confirm'=>Yii::t('BackendModule.backend', 'Внесённые изменения не будут сохранены. Выйти?'))),
);
?>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings') ?>"><?php echo Yii::t('BackendModule.backend', 'Настройки')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages') ?>"><?php echo Yii::t('BackendModule.backend', 'Страницы-сайта')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages', ['active_tab'=> 'tab1']) ?>"><?php echo Yii::t('BackendModule.backend', 'Стартовая')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/slider/admin') ?>"><?php echo Yii::t('BackendModule.backend', 'Слайдер')?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Создание')?></li>
	</ol>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>