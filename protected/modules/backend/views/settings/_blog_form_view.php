<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'property-list-settings-form',
    'action'=>Yii::app()->createUrl('/backend/settings/blog'),
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

<p style="margin-bottom: 30px;"></p>
<div class="clearfix"></div>
<?php if($bg_blog):?>
    <div class="clearfix"></div>
    <img src="<?php echo $bg_blog;?>" width="200">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Фоновое изображение");?></span>
        <input type="file" name="Settings[bg_blog]" id="Settings_bg_blog" value="<?php echo $bg_blog;?>">
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
                <li class="tab col s3"><a href="#setting_blog_ru" class="">Русский</a></li>
                <li class="tab col s3"><a class="" href="#setting_blog_ro">Молдавский</a></li>
                <li class="tab col s3"><a href="#setting_blog_en">Английский</a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="setting_blog_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_blog_ru"><?php echo Yii::t("base","Заголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_blog_ru]" id="Settings_title_blog_ru" type="text" maxlength="255"><?php echo $title_blog_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_blog_ru"><?php echo Yii::t("base","Подзаголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_blog_ru]" id="Settings_subtitle_blog_ru" type="text" maxlength="255"><?php echo $subtitle_blog_ru;?></textarea>
                </div>
            </div>
            <div id="setting_blog_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_blog_ro"><?php echo Yii::t("base","Заголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_blog_ro]" id="Settings_title_blog_ro" type="text" maxlength="255"><?php echo $title_blog_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_blog_ro"><?php echo Yii::t("base","Подзаголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_blog_ro]" id="Settings_subtitle_blog_ro" type="text" maxlength="255"><?php echo $subtitle_blog_ro;?></textarea>
                </div>
            </div>
            <div id="setting_blog_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_blog_en"><?php echo Yii::t("base","Заголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_blog_en]" id="Settings_title_blog_en" type="text" maxlength="255"><?php echo $title_blog_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_blog_en"><?php echo Yii::t("base","Подзаголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_blog_en]" id="Settings_subtitle_blog_en" type="text" maxlength="255"><?php echo $subtitle_blog_en;?></textarea>
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
