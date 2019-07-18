<?php
/* @var $this ContentBlockController */
/* @var $model ContentBlock */

//$label = $model->isNewRecord ? "Создать" : "Сохранить";
//Yii::app()->clientScript->registerScript('button-label', '
//                    var buttonLabel = \'' . $label . '\'
//                ', CClientScript::POS_HEAD);

$this->title = Yii::t('BackendModule.backend','Создание блока контента - тип недвижимости');

$this->breadcrumbs=array(
    Yii::t('BackendModule.backend','Управление блоками контента')=>array('admin'),
	'Создать',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Отмена'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('/backend/contentBlock/adminRealty'),'confirm'=>Yii::t('BackendModule.backend', 'Внесённые изменения не будут сохранены. Выйти?'))),
);
?>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings') ?>"><?php echo Yii::t('BackendModule.backend', 'Настройки')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages') ?>"><?php echo Yii::t('BackendModule.backend', 'Страницы-сайта')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages', ['active_tab'=> 'tab1']) ?>"><?php echo Yii::t('BackendModule.backend', 'Стартовая')?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/contentBlock/adminRealty') ?>"><?php echo Yii::t('BackendModule.backend', 'Типы-недвижимости')?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Создание')?></li>
	</ol>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>