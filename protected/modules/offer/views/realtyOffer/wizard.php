<?php
/**
 * @var $model RealtyOffer
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

<?php Yii::app()->clientScript->registerScript('form-id-var', "
    var form_id = 'blog-article-list';
    var ajax_url = '".$this->createUrl('/offer/realtyOffer/ajaxRealtyList')."';
    var callback = function() {
        var realtyId = $('#RealtyOffer_realty_id').val();
        $('.realty-item').each(function(i,node) {
            if ($(node).data('id') == realtyId) {
                $('.realty-item').removeClass('selected');
                $('#RealtyOffer_realty_id').val($(node).data('id'));
                $(node).addClass('selected');
            }
        })
    };
", CClientScript::POS_BEGIN); ?>

<div>
<h3>Выберите объект недвижимости для рекламы</h3>
<section data-step="0">
    <div class="wizard-content">
        <div class="row">
            <div class="col m12">
                <div class="row">
                    <?php echo $this->renderPartial('_realty_search', array('model' => $realty, 'form' => $form)); ?>
                    <?php $this->widget(
                        'backend.widgets.YListView',
                        array(
                            'id' => 'blog-article-list',
                            'dataProvider' => $realty->search(),
                            'itemView' => '_realty_grid',
                            'template' => '{sorter}{items}{pager}',
                            'itemsTagName' => 'ul',
                            'itemsCssClass' => 'mt-productlisthold list-inline',
                            'enableHistory' => true,
                            'cssFile' => false,
                            'ajaxUpdate'=>true,
                            'viewData' => array(
                                'realty' => $model,
                            ),
                            'sortableAttributes'=>array(
                                'created',
                            ),
                            'emptyText' => '<div class="col-xs-12 pb30"><div class="alert alert-info" role="alert">'.Yii::t("base", "No results").'</div></div>'
                        )
                    ); ?>
                    <?php echo $form->hiddenField($model, 'temp_id', array('value' => $model->getTempId())); ?>
                    <?php echo $form->hiddenField($model, 'realty_id'); ?>
                    <?php echo $form->error($model, 'realty_id'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<h3>Отредактируйте доступную информацию</h3>
<section data-step="1">
    <div class="wizard-content">
        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <ul class="collection left-info">
                            <li id="address" class="collection-item">
                                <?php
                                    if ($realty->addressTable) {
//                                        echo $realty->addressTable->search_string;
                                        echo $realty->addressTable->getAddress();
                                    }
                                ?>
                            </li>
                            <li id="area" class="collection-item">
                                <?php
                                    if ($realty->realtyDetailed && $realty->realtyDetailed->total_space_size != 0) {
                                        echo $realty->realtyDetailed->total_space_size
                                            .' '.Yii::app()->format->spaseSizeUnits($realty->realtyDetailed->space_size_units);
                                    } elseif ($realty->realtyDetailed && $realty->realtyDetailed->parcel_size) {
                                        echo $realty->realtyDetailed->parcel_size
                                            .' '.Yii::app()->format->parcelSizeUnits($realty->realtyDetailed->parcel_size_unit);
                                    }
                                ?>
                            </li>
                        </ul>
                        <?php echo CHtml::link(Yii::t("base", 'ДОБАВИТЬ'), '#', array(
                            'class' => 'addButton waves-effect waves-light btn blue m-b-xs'
                        )); ?>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <ul class="collection">
                            <li id="description" class="collection-item">
                                <?php echo $realty->description; ?>
                            </li>
                            <li class="collection-item">
                                <div class="col s12">
                                    <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                                        <li class="tab col s3"><a href="#test1" class="">Русский</a></li>
                                        <li class="tab col s3"><a class="" href="#test2">Молдавский</a></li>
                                        <li class="tab col s3"><a href="#test3">Английский</a></li>
                                        <div class="indicator" style="right: 0px; left: 397.5px;"></div>
                                    </ul>

                                    <div id="test1" class="col s12">
                                        <?php echo $form->textFieldGroup($model, 'title_ru'); ?>
                                        <?php echo $form->textFieldGroup($model, 'street_ru'); ?>
                                        <?php echo $form->tinyMceGroup($model,'description_ru', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
                                    </div>
                                    <div id="test2" class="col s12" style="display: none;">
                                        <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
                                        <?php echo $form->textFieldGroup($model, 'street_ro'); ?>
                                        <?php echo $form->tinyMceGroup($model,'description_ro', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
                                    </div>
                                    <div id="test3" class="col s12" style="display: none;">
                                        <?php echo $form->textFieldGroup($model, 'title_en'); ?>
                                        <?php echo $form->textFieldGroup($model, 'street_en'); ?>
                                        <?php echo $form->tinyMceGroup($model,'description_en', array('rows'=>6, 'cols'=>50, 'class' => 'hidden', 'labelOptions' => array('class' => 'hidden')), false); ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<h3>Укажите тип объявления</h3>
<section data-step="2">
    <div class="wizard-content">
        <div class="wizardTerms">
            <?php echo $form->dropDownListGroup($model, 'type', RealtyOffer::model()->getType(), array('class'=>'required', 'prompt' => 'Укажите тип объявления')); ?>

            <?php echo $form->textFieldGroup($model, 'ammount'); ?>

            <?php echo $form->dropDownListGroup($model, 'currency', RealtyOffer::model()->getCurrency(), array('class'=>'required', 'prompt' => 'Валюта')); ?>

            <?php echo $form->checkboxGroup($model, 'main_page',
                array('widgetOptions' =>
                    array(
                        'htmlOptions' => array(
                            'checked'=>$model->main_page ? true : $model->main_page
                        ),
                    ),
                    'labelOptions' => array(
                        'for' =>  CHtml::activeId($model, 'main_page'),
                    )
                )
            ); ?>
        </div>
    </div>
</section>
<h3>Добавьте фотографии и настройте порядок их отображения</h3>
<section data-step="3">
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
<h3>Просмотр</h3>
    <section >
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

<?php Yii::app()->clientScript->registerScript('search', "
    $(document).on('click', '.realty-item', function(event) {
        event.stopPropagation();
        var self = $(this);

        $.ajax({
            url: '".$this->createUrl('/offer/realtyOffer/checkRealtyType')."',
            data: {'item-id': self.data('id')},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    $('#address').html(data.data.address);
                    $('#area').html(data.data.area);
                    $('#description').html(data.data.description);

                    if (self.hasClass('selected')) {
                        $('#RealtyOffer_realty_id').val('');
                        self.removeClass('selected');
                    } else {
                        $('.realty-item').removeClass('selected');
                        $('#RealtyOffer_realty_id').val(self.data('id'));
                        self.addClass('selected');
                    }
                }
            }
        });
    });

    $('.dropdown-filter').change(function() {
        $.fn.yiiListView.update('blog-article-list', {
            data: {
                'Realty[type]': $('#Realty_type').val(),
                'Realty[searchAddress]': $('#Realty_searchAddress').val()
            },
            url: ajax_url,
            complete: callback
        });
        return false;
    });
"); ?>

<?php Yii::app()->clientScript->registerScript('sortable_realtyOffer',"

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
                    url: '" . Yii::app()->createUrl('offer/realtyOffer/tree') . "',
                    success:function (msg) {
                    }
                });
            }
        });
    }
", CClientScript::POS_LOAD); ?>

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