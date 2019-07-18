<?php
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
            var buttonLabel = \'' . $label . '\'
        ', CClientScript::POS_HEAD);
?>

<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'blog-article-form',
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>
<div>
<h3>Укажите информацию о статье</h3>
<section data-step="0">
    <div class="wizard-content">
        <div class="row">
            <div class="col m12">
                <div class="row">
                    <?php echo $form->fileFieldGroup($model,'image',array('class'=>'required','maxlength'=>255)); ?>

                    <?php echo $form->dropDownListGroup($model, 'category_id', CHtml::listData(ArticleCategory::model()->findAll(), 'id', 'title_'.Yii::app()->language)); ?>

                    <?php echo $form->textFieldGroup($model, 'author'); ?>

                    <?php echo $form->textFieldGroup($model, 'title'); ?>

                    <?php echo $form->textAreaGroup($model,'subtitle', array('rows'=>6, 'cols'=>50), true); ?>

                    <?php echo $form->dropDownListGroup($model,'language', BlogArticle::model()->getLanguages(), array('class'=>'required','maxlength'=>1)); ?>

                    <?php echo $form->checkboxGroup($model, 'is_active',
                        array('widgetOptions' =>
                            array(
                                'htmlOptions' => array(
                                    'checked'=>$model->isNewRecord ? true : $model->is_active
                                ),
                            ),
                            'labelOptions' => array(
                                'for' =>  CHtml::activeId($model, 'is_active'),
                            )
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<h3>Сверстайте статью</h3>
<section data-step="1">
    <div class="wizard-content">
        <div class="row">
            <?php echo $form->tinyMceGroup($model,'content', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
        </div>
    </div>
</section>
<h3>Просмотр</h3>
<section data-step="2">
    <div class="wizard-content preview">
        <div class="wizardTerms">

        </div>
    </div>
</section>
</div>
<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript('wizard-error-check', "
    function checkErrors(currentIndex) {
        var content = tinyMCE.get(unique_name_textarea0).getContent();
        $(basic_name_id0).html(content);

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

