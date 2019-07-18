<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'property-list-settings-form',
    'action'=>Yii::app()->createUrl('/backend/settings/propertySingle'),
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border'),
)); ?>

<div class="clearfix"></div>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#property_single_ru" class="">Русский</a></li>
                <li class="tab col s3"><a class="" href="#property_single_ro">Молдавский</a></li>
                <li class="tab col s3"><a href="#property_single_en">Английский</a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="property_single_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_button_rate_ru"><?php echo Yii::t("base","Заголовок кнопки Сделать ставку RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_button_rate_ru]" id="Settings_title_button_rate_ru" type="text" maxlength="255" value="<?php echo $title_button_rate_ru;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_print_ru"><?php echo Yii::t("base","Заголовок кнопки Распечатать RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_print_ru]" id="Settings_title_property_print_ru" type="text" maxlength="255" value="<?php echo $title_property_print_ru;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_agent_ru"><?php echo Yii::t("base","Заголовок болка Агент RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_agent_ru]" id="Settings_title_property_agent_ru" type="text" maxlength="255" value="<?php echo $title_property_agent_ru;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_desc_ru"><?php echo Yii::t("base","Заголовок болка Description RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_desc_ru]" id="Settings_title_property_desc_ru" type="text" maxlength="255" value="<?php echo $title_property_desc_ru;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_related_ru"><?php echo Yii::t("base","Заголовок болка Related Properties RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_related_ru]" id="Settings_title_property_related_ru" type="text" maxlength="255" value="<?php echo $title_property_related_ru;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_feat_ru"><?php echo Yii::t("base","Заголовок болка Ранее просмотренные RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_feat_ru]" id="Settings_title_property_feat_ru" type="text" maxlength="255" value="<?php echo $title_property_feat_ru;?>">
                </div>
            </div>
            <div id="property_single_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_button_rate_ro"><?php echo Yii::t("base","Заголовок кнопки Сделать ставку RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_button_rate_ro]" id="Settings_title_button_rate_ro" type="text" maxlength="255" value="<?php echo $title_button_rate_ro;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_print_ro"><?php echo Yii::t("base","Заголовок кнопки Распечатать RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_print_ro]" id="Settings_title_property_print_ro" type="text" maxlength="255" value="<?php echo $title_property_print_ro;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_agent_ro"><?php echo Yii::t("base","Заголовок болка Агент RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_agent_ro]" id="Settings_title_property_agent_ro" type="text" maxlength="255" value="<?php echo $title_property_agent_ro;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_desc_ro"><?php echo Yii::t("base","Заголовок болка Description RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_desc_ro]" id="Settings_title_property_desc_ro" type="text" maxlength="255" value="<?php echo $title_property_desc_ro;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_related_ro"><?php echo Yii::t("base","Заголовок болка Related Properties RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_related_ro]" id="Settings_title_property_related_ro" type="text" maxlength="255" value="<?php echo $title_property_related_ro;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_feat_ro"><?php echo Yii::t("base","Заголовок болка Ранее просмотренные RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_feat_ro]" id="Settings_title_property_feat_ro" type="text" maxlength="255" value="<?php echo $title_property_feat_ro;?>">
                </div>
            </div>
            <div id="property_single_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_button_rate_en"><?php echo Yii::t("base","Заголовок кнопки Сделать ставку EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_button_rate_en]" id="Settings_title_button_rate_en" type="text" maxlength="255" value="<?php echo $title_button_rate_en;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_print_en"><?php echo Yii::t("base","Заголовок кнопки Распечатать EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_print_en]" id="Settings_title_property_print_en" type="text" maxlength="255" value="<?php echo $title_property_print_en;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_agent_en"><?php echo Yii::t("base","Заголовок болка Агент EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_agent_en]" id="Settings_title_property_agent_en" type="text" maxlength="255" value="<?php echo $title_property_agent_en;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_desc_en"><?php echo Yii::t("base","Заголовок болка Description EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_desc_en]" id="Settings_title_property_desc_en" type="text" maxlength="255" value="<?php echo $title_property_desc_en;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_related_en"><?php echo Yii::t("base","Заголовок болка Related Properties EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_related_en]" id="Settings_title_property_related_en" type="text" maxlength="255" value="<?php echo $title_property_related_en;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_feat_en"><?php echo Yii::t("base","Заголовок болка Ранее просмотренные EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_property_feat_en]" id="Settings_title_property_feat_en" type="text" maxlength="255" value="<?php echo $title_property_feat_en;?>">
                </div>
            </div>
        </div>
    </li>
</ul>


<div class="clearfix"></div>

<?php $this->widget('booster.widgets.TbButton', array(
    'buttonType'=>'formSubmit',
    'htmlOptions' => array('class' => 'btn btn-success-custom'),
    'label'=> Yii::t("base","Сохранить"),
)); ?>

<?php $this->endWidget(); ?>
