<?php
    $cs = Yii::app()->clientScript;
    $cs->scriptMap['form-wizard.js'] = false;
?>

<?php $form = $this->beginWidget('backend.components.ActiveForm', array(
    'id' => 'info-block-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'inputContainer' => '.input-field',
    ),
    'type'=>'horizontal',
    'htmlOptions' => array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $form->fileFieldGroup($model, 'image', array('class'=>'required','maxlength'=>255)); ?>

    <div class="col s12">
        <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
            <li class="tab col s3"><a href="#test1" class="">Русский</a></li>
            <li class="tab col s3"><a class="" href="#test2">Молдавский</a></li>
            <li class="tab col s3"><a href="#test3">Английский</a></li>
            <div class="indicator" style="right: 0px; left: 397.5px;"></div>
        </ul>

        <div id="test1" class="col s12">
            <?php echo $form->textFieldGroup($model, 'title_ru'); ?>
            <?php echo $form->tinyMceGroup($model,'text_ru', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
        </div>
        <div id="test2" class="col s12" style="display: none;">
            <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
            <?php echo $form->tinyMceGroup($model,'text_ro', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
        </div>
        <div id="test3" class="col s12" style="display: none;">
            <?php echo $form->textFieldGroup($model, 'title_en'); ?>
            <?php echo $form->tinyMceGroup($model,'text_en', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
        </div>
    </div>

    <?php $this->widget('backend.widgets.YButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'waves-effect waves-light m-b-xs'),
        'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>


<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript('wizard-error-check', "
    $('#yw0').click(function() {
        var content0 = tinyMCE.get(unique_name_textarea0).getContent();
        $(basic_name_id0).html(content0);

        var content1 = tinyMCE.get(unique_name_textarea1).getContent();
        $(basic_name_id1).html(content1);

        var content2 = tinyMCE.get(unique_name_textarea2).getContent();
        $(basic_name_id2).html(content2);
        
        $('#info-block-form').submit();
        return false;
    });
", CClientScript::POS_END); ?>
