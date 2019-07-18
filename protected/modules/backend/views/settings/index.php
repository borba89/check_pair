<?php
    $this->title = Yii::t('BackendModule.backend', 'Способ создания объявлений');
    /*$this->menu=array(
        array('label'=>'Update Setting','url'=>array('update','id'=>$model->id)),
        array('label'=>'Manage Settings','url'=>array('admin', 'id' => Settings::GENERAL)),
    );*/
    $this->breadcrumbs=array(
        'Manage Settings'=>array('admin', 'id' => Settings::GENERAL),
        $model->id,
    );
?>

<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'settings-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

<div class="row">
    <div class="col s12">
        <!-- Switch -->
        <div class="switch m-b-md">
            <label>
                <?php echo Yii::t('BackendModule.backend', 'Из объектов недвижимости');?>
                <input type="checkbox" name="Settings[ad_creation]" value="1" <?php echo ($selected)?'checked':'';?>>
                <span class="lever"></span>
                <?php echo Yii::t('BackendModule.backend', 'Без объектов недвижимости');?>
            </label>
        </div>
    </div>
</div>

<?php $this->widget('booster.widgets.TbButton', array(
    'buttonType'=>'formSubmit',
    'htmlOptions' => array('class' => 'btn btn-primary'),
    'label'=>Yii::t('BackendModule.backend', 'Сохранить'),
)); ?>

<?php $this->endWidget(); ?>
