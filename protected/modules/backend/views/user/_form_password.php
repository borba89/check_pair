<?php $form = $this->beginWidget('backend.components.ActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'type'=>'horizontal',
)); ?>

<?php echo $form->passwordFieldGroup($model,'password',array('class'=>'span5','maxlength'=>64)); ?>

<?php echo $form->passwordFieldGroup($model,'password_repeat',array('class'=>'span5','maxlength'=>64)); ?>

<?php $this->widget('backend.widgets.YButton', array(
    'buttonType'=>'formSubmit',
    'htmlOptions' => array('class' => 'waves-effect waves-light m-b-xs'),
    'label'=>$model->isNewRecord ? 'Create' : 'Save',
)); ?>
</div>

<?php $this->endWidget(); ?>
