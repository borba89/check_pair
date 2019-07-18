<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'album-image-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListGroup($model,'item_id', CHtml::listData(Album::model()->findAll(),'id','title_'.Yii::app()->language),array('class'=>'form-control','maxlength'=>1)); ?>

    <?php $this->widget('booster.widgets.TbTabsLang', array(
        'type'=>'pills',
        'labelModel' => $model,
        'labelAttribute' => 'title_ru',
        'htmlOptions'=>array('class'=>'form-group'),
        'tabs'=>array(
            array('label'=>'RU', 'content'=>$form->textField($model,'title_ru',array('class'=>'form-control','maxlength'=>255)), 'active'=>($model->hasErrors('title_ru'))),
            array('label'=>'RO', 'content'=>$form->textField($model,'title_ro',array('class'=>'form-control','maxlength'=>255)), 'active'=>($model->hasErrors('title_ro'))),
        ),
    ));?>

    <?php echo $form->tagsFieldGroup($model,'tags',array('class'=>'span5')); ?>

    <?php echo $form->fileFieldGroup($model,'path',array('class'=>'form-control','maxlength'=>255)); ?>

    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'btn btn-primary'),
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>

<?php $this->endWidget(); ?>
