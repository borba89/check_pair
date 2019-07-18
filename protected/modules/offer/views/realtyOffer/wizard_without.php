<?php
/**
 * @var $model RealtyOffer
 */
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('backend.assets.js.pages').'/ad-form-wizard.js'
    ),
    CClientScript::POS_END
);
$disabled = $address->isNewRecord ? array('disabled' => "disabled") : array();
?>

<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'ad-article-form',
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

<div>
    <h3>Объект</h3>
    <section data-step="0">
        <div class="wizard-content realty-content">
            <div class="row">
                <div class="col m12">
                    <div class="row">
                        <!-- Поля объекта недвижимости Realty -->
                        <div class="col s12">

                            <?php echo $form->dropDownListGroup($realty, 'broker_id', User::model()->getUsersByRole('broker'), array('class'=>'', 'empty' => 'Назначьте агента')); ?>

                            <?php //echo Realty::model()->getRealtyType(0);
							echo $form->dropDownListGroup($realty, 'type', Realty::model()->getRealtyType(),
                                array('widgetOptions' =>
                                    array(
                                        'htmlOptions' => array(
                                            'data-realty-id' => $realty->id
                                        ),
                                    ),
                                )
                            ); ?>

                            <?php
//                            echo $form->dropDownListGroup($address, 'country', RealtyAddress::model()->getCountries(), array('class'=>'required ', 'prompt' => 'Укажите страну'));
                            ?>
                            <?php echo $form->hiddenField($address, 'country', array('value' => 'MD')); ?>

                            <?php echo $form->dropDownListGroup($address, 'city', RealtyAddress::model()->getCitiesAndSuburbs(), $disabled + array('class'=>'required', 'prompt' => 'Укажите город')); ?>
                            <div class="city_district-wrapper">
                                <?php echo $form->dropDownListGroup($address, 'city_district', RealtyAddress::model()->getAllDistrict(), $disabled + array('class' => 'required', 'prompt' => 'Укажите район')); ?>
                            </div>

                            <?php //echo $form->textFieldGroup($address, 'street'); ?>

                                <div class="m6 col s12">
<!--                                    --><?php //echo $form->labelEx($model,'lng', array('class'=>'label-offer-lang required')); ?>
                                    <div style="width: 100%; margin-left: 150px;">
                                        <label for="ytRealtyOffer_lng" style="font-size: 1rem;"><?php echo Yii::t("OfferModule.offer", 'Язык отображения на сайте') ?></label>
                                    </div>
                                    <?php echo $form->radioButtonList($model, 'lng', $model->getLang(), array(
                                        'template'=>'<span>{input} {label}</span>',
                                        'separator'=>'&nbsp;'
                                    ));?>
                                    <?php echo $form->error($model,'lng'); ?>
                                <style>
								    #RealtyOffer_street_ru::-webkit-input-placeholder
									{
										color: #9e9e9e;
									}
									#RealtyOffer_street_ro::-webkit-input-placeholder
									{
										color: #9e9e9e;
									}
									#RealtyOffer_street_en::-webkit-input-placeholder
									{
										color: #9e9e9e;
									}
									#RealtyOffer_street_ru::-moz-placeholder
									{
										color: #9e9e9e;
									}
									#RealtyOffer_street_ro::-moz-placeholder
									{
										color: #9e9e9e;
									}
									#RealtyOffer_street_en::-moz-placeholder
									{
										color: #9e9e9e;
									}
								</style>   
                                <div  class="col s12 col-lng col_ru">
                                    <?php echo $form->textField($model, 'street_ru', ['placeholder'=>'Название улицы', 'style'=>'margin-top:25px;margin-bottom:20px;']) ?>
                                </div>
                                <div  class="col s12 col-lng col_ro" style="display: none;">
                                    <?php echo $form->textField($model, 'street_ro', ['placeholder'=>'Название улицы', 'style'=>'margin-top:25px;margin-bottom:20px;']); ?>
                                </div>
                                <div  class="col s12 col-lng col_en" style="display: none;">
                                    <?php echo $form->textField($model, 'street_en', ['placeholder'=>'Название улицы', 'style'=>'margin-top:25px;margin-bottom:20px;']); ?>
                                </div>
                                </div>

                            <div class=" m6 input-field col s12">
                                <?php echo $form->label($address,'coord_url'); ?>
                                <?php echo $form->textField($address,'coord_url') ?>
                            </div>

                            <!-- @todo Проверить и если надо убрать из формы лишний -->
                            <?php echo $form->hiddenField($realty, 'temp_id', array('value' => $model->getTempId())); ?>
                            <?php echo $form->hiddenField($model, 'temp_id', array('value' => $model->getTempId())); ?>
                            <?php if(!$IsNew):?>
                                <?php echo $form->hiddenField($model, 'realty_id', array('value' => $model->realty_id)); ?>
                            <?php endif;?>
                            <?php echo CHtml::hiddenField('IsNew', $IsNew); ?>
                            <?php echo CHtml::hiddenField('model_id', $model->id); ?>
                        </div>

                        <div id="realty-detail-description" class="col s12">
                            <?php
//                            if (!$IsNew) {
                                echo $this->renderPartial('detail_information/'.$model->realty->type, array('realtyDetailed' => $realtyDetailed), true, false);
//                            }
                            ?>
                        </div>
                        <div class="col s12">
						    
						    <?php echo $form->dropDownListGroup($model, 'type', RealtyOffer::model()->getType(), array('class'=>'required', 'prompt' => 'Укажите тип объявления')); ?>
                            <div style="clear: both"></div>
                            <?php if (0) : ?>
                            <div class=" m6 input-field col s12">
                                <?php
                                echo $form->label($model,'ammount');
                                ?>
                                <?php
                                echo $form->textField($model,'ammount') . Yii::t("OfferModule.offer", 'EUR')
                                ?>
                            </div>
                            <?php endif ?>
                            <?php echo $form->maskField($model,'ammount',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
                            '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
                            )?>
                            <div class=" m6 input-field col s12 type_of_currency">
                                <?php echo Yii::t("OfferModule.offer", 'EUR'); ?>
                            </div>
                            <?php
                            echo $form->hiddenField($model, 'currency', array('value' => RealtyOffer::EURO));
                            ?>

                            <?php
    //                        echo $form->dropDownListGroup($model, 'currency', RealtyOffer::model()->getCurrency(), array('class'=>'required', 'prompt' => 'Валюта'));
                            ?>

                            <?php
                            //                            echo $form->checkboxGroup($model, 'main_page',
                            //                                array('widgetOptions' =>
                            //                                    array(
                            //                                        'htmlOptions' => array(
                            //                                            'checked'=>$model->main_page ? true : $model->main_page
                            //                                        ),
                            //                                    ),
                            //                                    'labelOptions' => array(
                            //                                        'for' =>  CHtml::activeId($model, 'main_page'),
                            //                                    )
                            //                                )
                            //                            );
                            ?>

                            <div class=" m6 input-field col s12">
                                <?php echo $form->label($model, 'main_page', array('class'=>'active')); ?>
                                <div class="switch switch-form-control">
                                    <label>
                                        <?php echo Yii::t("base","Нет"); ?>
                                        <?php echo $form->checkBox($model, 'main_page') ?>
                                        <span class="lever"></span>
                                        <?php echo Yii::t("base","Да"); ?>
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <h3><?php echo Yii::t("OfferModule.offer", 'Особенности') ?></h3>
    <section data-step="2">
        <div class="wizard-content">
            <div class="realty-detail-realty-tags">
                <?php $this->renderPartial('detail_information/_realty_tags', ['realtyTypeTags' => $realtyTypeTags, 'realty' => $realty]);?>
            </div>
        </div>
    </section>

    <?php if (0): ?>
    <h3>Описание</h3>
    <section data-step="3">
        <div class="wizard-content">
            <div  class="col s12 col-lng col_ru">
                <?php echo $form->textFieldGroup($model, 'title_ru'); ?>
                <?php echo $form->tinyMceGroup($model,'description_ru', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
            </div>
            <div  class="col s12 col-lng col_ro" style="display: none;">
                <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
                <?php echo $form->tinyMceGroup($model,'description_ro', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
            </div>
            <div  class="col s12 col-lng col_en" style="display: none;">
                <?php echo $form->textFieldGroup($model, 'title_en'); ?>
                <?php echo $form->tinyMceGroup($model,'description_en', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
            </div>
            <div  class="col s12 col-lng col_en">
            <button type="button" class="waves-effect waves-blue btn-flat" style="float: right">Сохранить в шаблон</button>
            </div>
<!--            <div class="wizardTerms">-->
<!--            </div>-->
        </div>
    </section>
    <?php endif; ?>

    <h3>Фото и видео</h3>
    <section data-step="4">
        <div class="wizard-content">
            <div class="row image-box">
                <?php $form->uploadifyRow($model, 'path', 'contypeImagesList'); ?>
            </div>

            <div class="row image-box">
                    <?php echo $form->textFieldGroup($videos, 'url'); ?>
            </div>

            <?php if(isset($existVideos) && $existVideos):?>
                <div class="row image-box">
                    <?php $this->renderPartial('_exist_videos', array('existVideos'=>$existVideos));?>
                </div>
            <?php endif;?>
        </div>
    </section>
<!--    <h3>Просмотр</h3>-->
<!--    <section data-step="4">-->
<!--        <div class="wizard-content preview">-->
<!--            <div class="wizardTerms">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
</div>
<?php $this->endWidget(); ?>

<?php
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
        var buttonLabel = \'' . $label . '\'
    ', CClientScript::POS_HEAD);
?>
<!-- Аякс валидация формы визарда -->
<?php Yii::app()->clientScript->registerScript('wizard-error-check', "
    function checkErrors(currentIndex) {
        return '[]';//jqxhr;
    }

    function submitWizard() {
        $('#ad-article-form').submit();
    }
", CClientScript::POS_END); ?>

<script>
    function sortable_realtyOffer() {
        if ($('div.image_add').length > 0) {
            $('div.image_add').sortable({
                forcePlaceholderSize:true,
                connectWith: ".image_add",
                items:'div.element',
                cursor: "move",
                revert: true,
                cursorAt: { left: 100,top: 110},
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
                    url: '<?php echo Yii::app()->createUrl('offer/realtyOffer/tree') ?>',
                    success:function (msg) {
                }
            });
            }
        });
        }
    }
</script>
<!-- Сортировка фотографий загруженных для объекта недвижимости -->
<?php Yii::app()->clientScript->registerScript('sortable_realtyOffer',"
    sortable_realtyOffer();
", CClientScript::POS_LOAD); ?>

<!-- Добавление дополнительных параметров к объявлению -->
<?php Yii::app()->clientScript->registerScript('addButton',"
    $('.addButton').on('click', function () {
        var count = $('ul[class*=left-info] li').length + 1;
        var self = $(this);

        $.ajax({
            url: '".Yii::app()->createUrl('/offer/realtyOffer/additem')."',
            dataType: 'json',
            type: 'GET',
            data: {count: count},
            success: function (data) {
                $('.left-info').append(data.data.responce);
            }
        });
        return false;
    });

    $(document).on('click', '.delete', function (evt) {
        evt.preventDefault();
        $(this).closest('li').remove();
        return false;
    });
    
", CClientScript::POS_READY);?>

<?php Yii::app()->clientScript->registerScript('switch_language_offer',"
    var newRecord = ".$model->isNewRecord."
    $('#RealtyOffer_lng input').on('click', function(){
        var lng = $('#RealtyOffer_lng input:checked').val();
//        var ru_text = $('.col_ru input').val();
        $('.col-lng').hide();
        $('.col_'+lng).show();
//        if (ru_text){
//            if (!$('.col_'+lng+' input').val()){
//                $('.col_'+lng+' input').val(ru_text);
//            }
//        }
    });
    $(document).on('input', '#myButton', function() {
   $.blockUI();
});
", CClientScript::POS_READY);?>


<?php
Yii::app()->clientScript->registerScript('check_new_offer',"
    var newRecord = ".(int)$model->isNewRecord.";", CClientScript::POS_HEAD);?>


