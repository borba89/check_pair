<?php
/* @var $this EmailTemplateController */
/* @var $model EmailTemplate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'email-template-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="clearfix"></div>

    <ul class="collection">
        <li class="collection-item">
            <div class="col s12">
                <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                    <li class="tab col s3"><a href="#test1" class="">Русский</a></li>
                    <li class="tab col s3"><a class="" href="#test2">Молдавский</a></li>
                    <li class="tab col s3"><a href="#test3">Английский</a></li>
                    <div class="indicator" style="right: 0px; left: 397.5px;"></div>
                </ul>
                <p class="clearfix"></p>
                <div id="test1" class="col s12">
                    <?php echo $form->textFieldGroup($model, 'subject_ru'); ?>
                    <div class="clearfix"></div>
                    <?php $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'message_ru',
                        'settings'=>array(
                            'toolbar' => 'undo redo | styleselect | bold italic | bullist numlist outdent indent | link ',
                        ),
                        'htmlOptions' => array(
                            'rows' => 6,
                            'cols' => 60,
                        ),
                    ));?>
                </div>
                <div id="test2" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'subject_ro'); ?>
                    <div class="clearfix"></div>
                    <?php $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'message_ro',
                        'settings'=>array(
                            'toolbar' => 'undo redo | styleselect | bold italic | bullist numlist outdent indent | link ',
                        ),
                        'htmlOptions' => array(
                            'rows' => 6,
                            'cols' => 60,
                        ),
                    ));?>
                </div>
                <div id="test3" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'subject_en'); ?>
                    <div class="clearfix"></div>
                    <?php $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'message_en',
                        'settings'=>array(
                            'toolbar' => 'undo redo | styleselect | bold italic | bullist numlist outdent indent | link ',
                        ),
                        'htmlOptions' => array(
                            'rows' => 6,
                            'cols' => 60,
                        ),
                    ));?>
                </div>
            </div>
        </li>
    </ul>

	<div class="row">
		<?php echo $form->checkBox($model,'status'); ?>
        <?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-primary'),
            'label'=>'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->