<?php
/* @var $this AboutEmployeesController */
/* @var $model AboutEmployees */
/* @var $form CActiveForm */
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
        var buttonLabel = \'' . $label . '\'
    ', CClientScript::POS_HEAD);
?>

<div class="form">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'about-employees-form',
	'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions' => array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

	<?php echo $form->errorSummary($model); ?>


    <?php echo $form->fileFieldGroup($model, 'image', array('class'=>'required','maxlength'=>255)); ?>

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
                    <?php echo $form->textFieldGroup($model, 'title_ru'); ?>
                    <?php echo $form->textFieldGroup($model, 'subtitle_ru'); ?>
                    <div class="clearfix"></div>
                    <?php $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text_ru',
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
                    <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
                    <?php echo $form->textFieldGroup($model, 'subtitle_ro'); ?>
                    <div class="clearfix"></div>
                    <?php $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text_ro',
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
                    <?php echo $form->textFieldGroup($model, 'title_en'); ?>
                    <?php echo $form->textFieldGroup($model, 'subtitle_en'); ?>
                    <div class="clearfix"></div>
                    <?php $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text_en',
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


    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-primary'),
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->