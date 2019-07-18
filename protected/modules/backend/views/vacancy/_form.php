<?php
/* @var $this VacancyController */
/* @var $model Vacancy */
/* @var $form CActiveForm */
$show_ru = '';
$show_ro = 'style="display: none;"';
$show_en = 'style="display: none;"';
if(!$model->isNewRecord){
    switch ($model->lang){
        case 'ru':
            $show_ru = 'style="display: block;"';
            $show_ro = 'style="display: none;"';
            $show_en = 'style="display: none;"';
            break;
        case 'ro':
            $show_ru = 'style="display: none;"';
            $show_ro = 'style="display: block;"';
            $show_en = 'style="display: none;"';
            break;
        case 'en':
            $show_ru = 'style="display: none;"';
            $show_ro = 'style="display: none;"';
            $show_en = 'style="display: block;"';
            break;
    }
}
?>

<div class="form">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'vacancy-form',
	'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions' => array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $form->fileFieldGroup($model, 'image', array('class'=>'required','maxlength'=>255)); ?>

    <div class="clearfix"></div>

    <ul class="collection">
        <li class="collection-item">
            <div class="col s12">
                <!--<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                    <li class="tab col s3"><a href="#test1" class="">Русский</a></li>
                    <li class="tab col s3"><a class="" href="#test2">Молдавский</a></li>
                    <li class="tab col s3"><a href="#test3">Английский</a></li>
                    <div class="indicator" style="right: 0px; left: 397.5px;"></div>
                </ul>-->

                <div class="col s12">
                    <?php echo $form->labelEx($model,'lang', array('class'=>'label-offer-lang required')); ?>
                    <?php echo $form->radioButtonList($model, 'lang', $model->getLang(), array(
                        'template'=>'<span>{input} {label}</span>',
                        'separator'=>'&nbsp;'
                    ));?>
                    <?php echo $form->error($model,'lang'); ?>
                </div>

                <p class="clearfix"></p>
                <div id="col_ru" class="col s12 col-lng" <?php echo $show_ru;?>>
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
                <div id="col_ro" class="col s12 col-lng" <?php echo $show_ro;?>>
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
                <div id="col_en" class="col s12 col-lng" <?php echo $show_en;?>>
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
            'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerScript('switch_language_offer',"
    var newRecord = ".$model->isNewRecord."
    $('#Vacancy_lang input').on('click', function(){
        var lng = $('#Vacancy_lang input:checked').val();
        $('.col-lng').hide();
        $('#col_'+lng).show();
        console.log($('#Vacancy_lang input:checked').val());
    });
", CClientScript::POS_READY);?>

<?php
Yii::app()->clientScript->registerScript('check_new_offer',"
    var newRecord = ".(int)$model->isNewRecord.";", CClientScript::POS_HEAD);?>
