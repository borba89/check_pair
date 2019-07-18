<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'ad-article-form',
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>
<?php echo $form->dropDownListGroup($address, 'city_district', $district, array('class'=>'required', 'prompt' => 'Укажите район')); ?>
<?php $this->endWidget(); ?>
