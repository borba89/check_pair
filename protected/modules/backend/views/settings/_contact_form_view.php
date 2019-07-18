<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'property-list-settings-form',
    'action'=>Yii::app()->createUrl('/backend/settings/contact'),
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

<p style="margin-bottom: 30px;"></p>
<div class="clearfix"></div>
<?php if($bg_contact):?>
    <div class="clearfix"></div>
    <img src="<?php echo $bg_contact;?>" width="200">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Фоновое изображение");?></span>
        <input type="file" name="Settings[bg_contact]" id="Settings_bg_contact" value="<?php echo $bg_contact;?>">
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
                <li class="tab col s3"><a href="#setting_contact_ru" class="">Русский</a></li>
                <li class="tab col s3"><a class="" href="#setting_contact_ro">Молдавский</a></li>
                <li class="tab col s3"><a href="#setting_contact_en">Английский</a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="setting_contact_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_contact_ru"><?php echo Yii::t("base","Заголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_contact_ru]" id="Settings_title_contact_ru" type="text" maxlength="255"><?php echo $title_contact_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_contact_ru"><?php echo Yii::t("base","Подзаголовок блока RU");?> <span class="required">*</span></label>
        			<textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_contact_ru]" id="Settings_subtitle_contact_ru" type="text" maxlength="255"><?php echo $subtitle_contact_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_form_contact_ru"><?php echo Yii::t("base","Заголовок формы RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[form_contact_ru]" id="Settings_form_contact_ru" type="text" maxlength="255"><?php echo $form_contact_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_side_contact_ru"><?php echo Yii::t("base","Заголовок блока контактов RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[side_contact_ru]" id="Settings_side_contact_ru" type="text" maxlength="255"><?php echo $side_contact_ru;?></textarea>
                </div>
            </div>
            <div id="setting_contact_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_contact_ro"><?php echo Yii::t("base","Заголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_contact_ro]" id="Settings_title_contact_ro" type="text" maxlength="255"><?php echo $title_contact_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_contact_ro"><?php echo Yii::t("base","Подзаголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_contact_ro]" id="Settings_subtitle_contact_ro" type="text" maxlength="255"><?php echo $subtitle_contact_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_form_contact_ro"><?php echo Yii::t("base","Заголовок формы RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[form_contact_ro]" id="Settings_form_contact_ro" type="text" maxlength="255"><?php echo $form_contact_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_side_contact_ro"><?php echo Yii::t("base","Заголовок блока контактов RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[side_contact_ro]" id="Settings_side_contact_ro" type="text" maxlength="255"><?php echo $side_contact_ro;?></textarea>
                </div>
            </div>
            <div id="setting_contact_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_contact_en"><?php echo Yii::t("base","Заголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_contact_en]" id="Settings_title_contact_en" type="text" maxlength="255"><?php echo $title_contact_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_contact_en"><?php echo Yii::t("base","Подзаголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_contact_en]" id="Settings_subtitle_contact_en" type="text" maxlength="255"><?php echo $subtitle_contact_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_form_contact_en"><?php echo Yii::t("base","Заголовок формы EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[form_contact_en]" id="Settings_form_contact_en" type="text" maxlength="255"><?php echo $form_contact_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_side_contact_en"><?php echo Yii::t("base","Заголовок блока контактов EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[side_contact_en]" id="Settings_side_contact_en" type="text" maxlength="255"><?php echo $side_contact_en;?></textarea>
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
