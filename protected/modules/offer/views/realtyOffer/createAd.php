<?php
	$this->breadcrumbs=array(
        'Realty Offers'=>array('admin'),
        'Create',
    );

    $this->menu=array(
        array('label'=>Yii::t('BackendModule.backend', 'Отмена'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('/offer/realtyOffer/admin'),'confirm'=>Yii::t('BackendModule.backend', 'Внесённые изменения не будут сохранены. Выйти?'))),
    );
    $this->title = "Новое объявление - ID " . $model->primaryKey;

?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl("offer/realtyOffer/admin") ?>"><?php echo Yii::t('BackendModule.backend', 'Объявления')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $model->primaryKey ?></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Создание') ?></li>
    </ol>

<?php echo $this->renderPartial('wizard_without', array(
    'model'=>$model,
    'realty' => $realty,
    'address'=>$address,
    'realtyDetailed' => $realtyDetailed,
    'videos'=>$videos,
    'IsNew' => $IsNew,
    'realtyTypeTags' => $realtyTypeTags,
)); ?>