<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $form->errorSummary($model); ?>


    <?php if(isset($group)) { ?>
        <?php foreach ($group as $key => $item) { ?>
            <?php if(Yii::app()->user->id == 1) { ?>
                <?php echo $form->dropDownListGroup($model, "[$key]type", $model->types, array('class'=>'form-control','maxlength'=>1)); ?>
                <?php echo $form->textFieldGroup($item, "[$key]group", array('class'=>'form-control','maxlength'=>80)); ?>
                <?php echo $form->textFieldGroup($item, "[$key]name", array('class'=>'form-control','maxlength'=>20)); ?>
                <?php echo $form->textFieldGroup($item, "[$key]description", array('class'=>'form-control','maxlength'=>255)); ?>
            <?php } ?>

            <?php /*if(Yii::app()->user->id !== '1') {
                    echo CHtml::openTag('div', array('class' => 'form-group'));
                    echo CHtml::tag('label', array('class' => "col-sm-3 control-label"), $item->description);
                    echo CHtml::closeTag('div');
            } */?>

            <?php if($item->type == Settings::IMAGE) { ?>
                <?php echo $form->hiddenField($item, "[$key]data", array('class'=>'form-control','maxlength'=>255, 'value' => 2)); ?>
                <?php echo $form->fileFieldGroup($item, "[$key]value", array('class'=>'form-control','maxlength'=>255, 'label' => $item->description)); ?>
            <?php } elseif($item->type == "textArea") { ?>
                <?php echo $form->textAreaGroup($item, "[$key]value", array('rows'=>6, 'cols'=>50, 'class'=>'span8', 'label' => $item->description, 'widgetOptions' => array('htmlOptions' => array('placeholder' => false)))); ?>
            <?php } elseif($item->type == Settings::WYSIWYG) { ?>
                <?php echo $form->tinyMceGroup($item, "[$key]value", array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
            <?php } elseif($item->type == Settings::CHECKFIELD) { ?>
                <?php echo $form->checkboxGroup($item, "[$key]value"); ?>
            <?php } elseif($item->type == Settings::TEXTFIELD) { ?>
                <?php echo $form->textFieldGroup($item, "[$key]value", array('class' => 'form-control', 'maxlength' => 80, 'labelOverride' => $item->description)); ?>
            <?php } ?>

            <?php echo $form->hiddenField($item, "[$key]cur_id", array('class'=>'form-control','maxlength'=>255, 'value' => $item->id)); ?>
        <?php } ?>
    <?php } else { ?>
        <?php if(Yii::app()->user->id == 1) { ?>
            <?php echo $form->dropDownListGroup($model,'type', $model->types, array('class'=>'form-control','maxlength'=>1)); ?>
            <?php echo $form->textFieldGroup($model,'group',array('class'=>'form-control','maxlength'=>80)); ?>
            <?php echo $form->textFieldGroup($model,'name',array('class'=>'form-control','maxlength'=>20)); ?>
            <?php echo $form->textFieldGroup($model,'description',array('class'=>'form-control','maxlength'=>255)); ?>
        <?php } ?>

        <?php if($model->type == Settings::IMAGE) { ?>
            <?php echo $form->hiddenField($model,'data',array('class'=>'form-control','maxlength'=>255, 'value' => 2)); ?>
            <?php echo $form->fileFieldGroup($model,'value',array('class'=>'form-control','maxlength'=>255)); ?>
        <?php } elseif($model->type == Settings::TEXTAREA) { ?>
            <?php echo $form->textAreaGroup($model,'value',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php } elseif($model->type == Settings::WYSIWYG) { ?>
            <?php echo $form->tinyMceGroup($model,'value',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
        <?php } elseif($model->type == Settings::CHECKFIELD) { ?>
            <?php echo $form->checkboxGroup($model, 'value'); ?>
        <?php } else { ?>
            <?php echo $form->textFieldGroup($model, 'value', array('class' => 'form-control', 'maxlength' => 80)); ?>
        <?php } ?>
    <?php } ?>

    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'btn btn-primary'),
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>

<?php $this->endWidget(); ?>