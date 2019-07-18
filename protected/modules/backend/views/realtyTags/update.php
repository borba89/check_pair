<?php
/* @var $this SliderController */
/* @var $model Slider */
$this->title = Yii::t('BackendModule.backend', 'Редактирование особенности объекта недвижимости');

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend', 'Отмена'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('/backend/realtyTags/admin'),'confirm'=>Yii::t('BackendModule.backend', 'Внесённые изменения не будут сохранены. Выйти?'))),
);
?>

	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'Справочники')?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/realtyTags/admin') ?>"><?php echo Yii::t('BackendModule.backend', 'Особенности объекта')?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo $model->primaryKey?></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Редактирование')?></li>
	</ol>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>