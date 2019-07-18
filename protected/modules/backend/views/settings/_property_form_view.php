<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'property-list-settings-form',
    'action'=>Yii::app()->createUrl('/backend/settings/propertyList'),
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>
<p style="margin-bottom: 30px;"></p>
<div class="clearfix"></div>
<?php if($bg_property_list):?>
    <div class="clearfix"></div>
    <img src="<?php echo $bg_property_list;?>" width="200">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Фоновое изображение");?></span>
        <input type="file" name="Settings[bg_property_list]" id="Settings_bg_property_list" value="<?php echo $bg_property_list;?>">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text">
    </div>
</div>


<div class="clearfix"></div>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#property_list_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#property_list_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#property_list_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="property_list_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_list_ru"><?php echo Yii::t("base","Заголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_property_list_ru]" id="Settings_title_property_list_ru" type="text" maxlength="255"><?php echo $title_property_list_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_property_list_ru"><?php echo Yii::t("base","Подзаголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_property_list_ru]" id="Settings_subtitle_property_list_ru" type="text" maxlength="255"><?php echo $subtitle_property_list_ru;?></textarea>
                </div>
            </div>
            <div id="property_list_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_list_ro"><?php echo Yii::t("base","Заголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_property_list_ro]" id="Settings_title_property_list_ro" type="text" maxlength="255"><?php echo $title_property_list_ro;?></textarea>
				</div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_property_list_ro"><?php echo Yii::t("base","Подзаголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_property_list_ro]" id="Settings_subtitle_property_list_ro" type="text" maxlength="255"><?php echo $subtitle_property_list_ro;?></textarea>
                </div>
            </div>
            <div id="property_list_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_property_list_en"><?php echo Yii::t("base","Заголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_property_list_en]" id="Settings_title_property_list_en" type="text" maxlength="255"><?php echo $title_property_list_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_property_list_en"><?php echo Yii::t("base","Подзаголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_property_list_en]" id="Settings_subtitle_property_list_en" type="text" maxlength="255"><?php echo $subtitle_property_list_en;?></textarea>
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
