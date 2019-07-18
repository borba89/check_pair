<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'settings-about-form',
    'action'=>Yii::app()->createUrl('/backend/settings/about'),
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

<div class="clearfix"></div>
<p style="margin-bottom: 30px;"></p>
<div class="clearfix"></div>


<?php if($bg_about):?>
    <div class="clearfix"></div>
    <img src="<?php echo $bg_about;?>" width="200">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Фоновое изображение");?></span>
        <input type="file" name="Settings[bg_about]" id="Settings_bg_about" value="<?php echo $bg_about;?>">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text">
    </div>
</div>
<div class="clearfix"></div>

<!-- Настройки блока "About us" -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Настройка блока "About us"')?></h5>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#about_ru" class="">Русский</a></li>
                <li class="tab col s3"><a class="" href="#about_ro">Молдавский</a></li>
                <li class="tab col s3"><a href="#about_en">Английский</a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="about_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_about_ru"><?php echo Yii::t("base","Заголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_about_ru]" id="Settings_title_about_ru" type="text" maxlength="255"><?php echo $title_about_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_about_ru"><?php echo Yii::t("base","Подзаголовок блока RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_about_ru]" id="Settings_subtitle_about_ru" type="text" maxlength="255"><?php echo $subtitle_about_ru;?></textarea>
                </div>
            </div>
            <div id="about_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_about_ro"><?php echo Yii::t("base","Заголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_about_ro]" id="Settings_title_about_ro" type="text" maxlength="255"><?php echo $title_about_ro;?></textarea>
	            </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_about_ro"><?php echo Yii::t("base","Подзаголовок блока RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_about_ro]" id="Settings_subtitle_about_ro" type="text" maxlength="255"><?php echo $subtitle_about_ro;?></textarea>
                </div>
            </div>
            <div id="about_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_about_en"><?php echo Yii::t("base","Заголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_about_en]" id="Settings_title_about_en" type="text" maxlength="255"><?php echo $title_about_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_about_en"><?php echo Yii::t("base","Подзаголовок блока EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_about_en]" id="Settings_subtitle_about_en" type="text" maxlength="255"><?php echo $subtitle_about_en;?></textarea>
                </div>
            </div>
        </div>
    </li>
</ul>

<!-- Настройки блока We are since -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Блок "We are since"')?></h5>

<?php if($bg_since):?>
    <div class="clearfix"></div>
    <img src="<?php echo $bg_since;?>" width="200">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Изображение");?></span>
        <input type="file" name="Settings[bg_since]" id="Settings_bg_since" value="<?php echo $bg_since;?>">
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
                <li class="tab col s3"><a href="#since_ru" class="">Русский</a></li>
                <li class="tab col s3"><a class="" href="#since_ro">Молдавский</a></li>
                <li class="tab col s3"><a href="#since_en">Английский</a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="since_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_since_ru"><?php echo Yii::t("base","Заголовок блока RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_since_ru]" id="Settings_title_since_ru" type="text" maxlength="255" value="<?php echo $title_since_ru;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_since_ru"><?php echo Yii::t("base","Подзаголовок блока RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[subtitle_since_ru]" id="Settings_subtitle_since_ru" type="text" maxlength="600" value="<?php echo $subtitle_since_ru;?>">
                </div>
            </div>
            <div id="since_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_since_ro"><?php echo Yii::t("base","Заголовок блока RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_since_ro]" id="Settings_title_since_ro" type="text" maxlength="255" value="<?php echo $title_since_ro;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_since_ro"><?php echo Yii::t("base","Подзаголовок блока RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[subtitle_since_ro]" id="Settings_subtitle_since_ro" type="text" maxlength="600" value="<?php echo $subtitle_since_ro;?>">
                </div>
            </div>
            <div id="since_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_since_en"><?php echo Yii::t("base","Заголовок блока Типы недвижимости EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[title_since_en]" id="Settings_title_since_en" type="text" maxlength="255" value="<?php echo $title_since_en;?>">
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_since_en"><?php echo Yii::t("base","Подзаголовок блока Типы недвижимости EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[subtitle_since_en]" id="Settings_subtitle_since_en" type="text" maxlength="600" value="<?php echo $subtitle_since_en;?>">
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
