<?php
/* @var $this SliderController */
/* @var $model Slider */
/* @var $form CActiveForm */

$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
        var buttonLabel = \'' . $label . '\'
    ', CClientScript::POS_HEAD);
?>

<div class="form collection-no-border">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'slider-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <ul class="collection">
        <li class="collection-item">
            <div class="col s12">
                <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                    <li class="tab col s3"><a href="#test1" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                    <li class="tab col s3"><a class="" href="#test2"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                    <li class="tab col s3"><a href="#test3"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                    <div class="indicator" style="right: 0px; left: 397.5px;"></div>
                </ul>
                <p class="clearfix" style="height: 10px;"></p>
                <div id="test1" class="col s12">
                    <?php echo $form->textFieldGroup($model, 'title_ru'); ?>
                    <div class="clearfix"></div>
                    <?php echo $form->textAreaGroup($model, 'subtitle_ru',
                        ['widgetOptions' =>
                            ['htmlOptions' =>
                                ['class'=> 'textarea-like-input']]]
                    ); ?>
                    <?php
//                    $this->widget('ext.tinymce.TinyMce', array(
//                        'model' => $model,
//                        'attribute' => 'subtitle_ru',
//                        'settings'=>array(
////                            'menubar' => false,
//                            'menubar' => "file edit view",
//                            'toolbar' => 'undo redo',
////                            'toolbar' => 'undo redo | styleselect | bold italic | bullist numlist outdent indent | link ',
//                        ),
//                        'htmlOptions' => array(
//                            'rows' => 6,
//                            'cols' => 60,
//                        ),
//                    ));
                    ?>
                </div>
                <div id="test2" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
                    <div class="clearfix"></div>
                    <?php echo $form->textAreaGroup($model, 'subtitle_ro',
                    ['widgetOptions' =>
                        ['htmlOptions' =>
                            ['class'=> 'textarea-like-input']]]
                    ); ?>
                    <?php
//                    $this->widget('ext.tinymce.TinyMce', array(
//                        'model' => $model,
//                        'attribute' => 'subtitle_ro',
//                        'settings'=>array(
//                            'menubar' => "file edit view",
//                            'toolbar' => 'undo redo',
//                        ),
//                        'htmlOptions' => array(
//                            'rows' => 6,
//                            'cols' => 60,
//                        ),
//                    ));
                    ?>
                </div>
                <div id="test3" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'title_en'); ?>
                    <div class="clearfix"></div>
                    <?php echo $form->textAreaGroup($model, 'subtitle_en',
                        ['widgetOptions' =>
                            ['htmlOptions' =>
                                ['class'=> 'textarea-like-input']]]
                    ); ?>
                    <?php
//                    $this->widget('ext.tinymce.TinyMce', array(
//                        'model' => $model,
//                        'attribute' => 'subtitle_en',
//                        'settings'=>array(
//                            'menubar' => "file edit view",
//                            'toolbar' => 'undo redo',
//                        ),
//                        'htmlOptions' => array(
//                            'rows' => 6,
//                            'cols' => 60,
//                        ),
//                    ));
                    ?>
                </div>
            </div>
        </li>
    </ul>


    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-success-custom'),
            'label'=>$model->isNewRecord ? "Создать" : "Сохранить",
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerScript('wizard-error-check', "
    function checkErrors(currentIndex) {
        var content0 = tinyMCE.get(unique_name_textarea0).getContent();
        $(basic_name_id0).html(content0);

        var content1 = tinyMCE.get(unique_name_textarea1).getContent();
        $(basic_name_id1).html(content1);

        var content2 = tinyMCE.get(unique_name_textarea2).getContent();
        $(basic_name_id2).html(content2);

        var formData = new FormData($('#blog-article-form')[0]);
        formData.append('ajax', 'blog-article-form');
        formData.append('step', 'step' + currentIndex);

        var jqxhr = $.ajax({
            type:'POST',
            data: formData,
            dataType: 'json',
            global: false,
            async: false,
            success: function (data) {
                if(data.length == 0) {
                    hideFormErrors(form='#blog-article-form');
                } else {
                    formErrors(data,form='#blog-article-form');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        }).responseText;

        return jqxhr;
    }

    function submitWizard() {
        $('#blog-article-form').submit();
    }
", CClientScript::POS_END); ?>