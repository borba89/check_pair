<?php
/**
 * @var $realtyModel RealtyOffer
 */
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

<?php
    $disabled = $address->isNewRecord ? array('disabled' => "disabled") : array();
?>
<div>
<h3>Основная информация</h3>
<section data-step="0">
    <div class="wizard-content realty-content">
        <div class="row">
            <div class="col m12">
                <div class="row">
                    <?php echo $form->dropDownListGroup($model, 'type', Realty::model()->getRealtyType(), array('class'=>'required')); ?>

                    <?php echo $form->dropDownListGroup($address, 'country', RealtyAddress::model()->getCountries(), array('class'=>'required', 'prompt' => 'Select a country')); ?>

                    <?php echo $form->dropDownListGroup($address, 'city', RealtyAddress::model()->getCities(), $disabled + array('class'=>'required', 'prompt' => 'Select a city')); ?>

                    <?php echo $form->dropDownListGroup($address, 'city_district', RealtyAddress::model()->getDistrict(), $disabled + array('class'=>'required', 'prompt' => 'Select a district')); ?>

                    <?php echo $form->textFieldGroup($address, 'street'); ?>

                    <?php echo $form->tinyMceGroup($model,'description', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>

                    <?php echo $form->hiddenField($model, 'temp_id', array('value' => $model->getTempId())); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<h3>Детальная информация</h3>
<section data-step="1">
    <div class="wizard-content">
        <div class="row">
            <?php if (!$model->isNewRecord) {
                echo $this->renderPartial('detail_information/'.$model->type, array('realtyDetailed' => $realtyDetailed), true, false);
            } else {
                echo $this->renderPartial('detail_information/land_pot', array('realtyDetailed' => $realtyDetailed), true, false);
            } ?>
        </div>
    </div>
</section>
    <h3>Укажите тип объявления</h3>
    <section data-step="2">
        <div class="wizard-content">
            <div class="wizardTerms">
                <?php echo $form->dropDownListGroup($realtyModel, 'type', RealtyOffer::model()->getType(), array('class'=>'required', 'prompt' => 'Укажите тип объявления')); ?>

                <?php echo $form->textFieldGroup($realtyModel, 'ammount'); ?>

                <?php echo $form->dropDownListGroup($realtyModel, 'currency', RealtyOffer::model()->getCurrency(), array('class'=>'required', 'prompt' => 'Валюта')); ?>

                <?php echo $form->checkboxGroup($realtyModel, 'main_page',
                    array('widgetOptions' =>
                        array(
                            'htmlOptions' => array(
                                'checked'=>$realtyModel->main_page ? true : $realtyModel->main_page
                            ),
                        ),
                        'labelOptions' => array(
                            'for' =>  CHtml::activeId($realtyModel, 'main_page'),
                        )
                    )
                ); ?>
            </div>
        </div>
    </section>

    <h3>Добавьте фотографии</h3>
<section data-step="2">
    <div class="wizard-content">
        <div class="row">
            <?php $form->uploadifyRow($model, 'path', 'contypeImagesList'); ?>
        </div>
    </div>
</section>
<h3>Просмотр</h3>
<section data-step="3">
    <div class="wizard-content preview">
        <div class="wizardTerms">

        </div>
    </div>
</section>
</div>
<?php $this->endWidget(); ?>

<?php
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
        var buttonLabel = \'' . $label . '\'
    ', CClientScript::POS_HEAD);
?>

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
                if (data.length == 0) {
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

<?php Yii::app()->clientScript->registerScript('sortable_realty',"
    if ($('div.image_add').length > 0) {
        $('div.image_add').sortable({
            forcePlaceholderSize:true,
            connectWith: \".image_add\",
            items:'div.element',
            cursor: \"move\",
            start: function(e, ui){
                ui.placeholder.height(ui.item.height());
            },
            update: function(event, ui){
                var arraied = $(this).sortable('toArray', {attribute: 'data-id'});
                $.ajax({
                    type:'POST',
                    data:{
                        ids:arraied
                    },
                    url: '" . Yii::app()->createUrl('realty/realty/tree') . "',
                    success:function (msg) {
                    }
                });
            }
        });
    }
", CClientScript::POS_LOAD); ?>

<?php Yii::app()->clientScript->registerScript('realty-wizard', "
    $('#RealtyAddress_country').change(function() {
        var city = $('#RealtyAddress_city');
        var countryVal = $(this).val();
        $.ajax({
            type:'POST',
            url: '".Yii::app()->controller->createUrl('/realty/realty/citySearch')."',
            data: {country: countryVal},
            dataType: 'json',
            success: function (data) {
                city.empty();
                $.each(data, function() {
                    city.append('<option value=\"'+ this.id +'\">'+ this.name +'</option>');
                    city.prop('disabled', false);
                    city.material_select();
                })
                $('#RealtyAddress_city').trigger( \"change\" );
            }
        });
    });

    $('#RealtyAddress_city').change(function() {
        var district = $('#RealtyAddress_city_district');
        var cityVal = $(this).val();
        $.ajax({
            type:'POST',
            url: '".Yii::app()->controller->createUrl('/realty/realty/cityDistrictSearch')."',
            data: {city: cityVal},
            dataType: 'json',
            success: function (data) {
                district.empty();
                $.each(data, function() {
                    district.append('<option value=\"'+ this.id +'\">'+ this.name +'</option>');
                    district.prop('disabled', false);
                    district.material_select();
                })
            }
        });
    });
", CClientScript::POS_READY); ?>
