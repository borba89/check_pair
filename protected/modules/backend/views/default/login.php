<?php
/**
 * @var $this BackendController
 * @var $model BackendLoginForm
 * @var $form CActiveForm
 */
?>

<div class="row">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
            'inputContainer' => '.input-field',
        ),
        'htmlOptions' => array(
            'class' => 'col s12',
        ),
    )); ?>

    <div class="input-field col s12">
        <?php echo $form->textField($model, 'email', array('class' => 'validate', 'autofocus' => 1)); ?>
        <?php echo $form->label($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="input-field col s12">
        <?php echo $form->passwordField($model, 'password', array('class' => 'validate', 'autofocus' => 1)); ?>
        <?php echo $form->label($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="input-field col s12">
        <p class="p-v-xs">
            <?php echo $form->checkBox($model, 'rememberMe',array('style'=>'margin-bottom: 20px')); ?>
            <?php echo $form->label($model, 'rememberMe'); ?>
        </p>
    </div>
    <div class="col s12 right-align m-t-sm">
        <?php echo CHtml::submitButton('Sign in', array("class" => "btn btn-primary btn-block")); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>

