<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'settings-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

<div class="clearfix"></div>
<p style="margin-bottom: 30px;"></p>
<div class="clearfix"></div>

<div class="input-field col s12 ">
    <label class="active required" for="Settings_company_name"><?php echo Yii::t("base","Название организации");?> <span class="required">*</span></label>
    <input class="form-control" name="Settings[company_name]" id="Settings_company_name" type="text" maxlength="255" value="<?php echo $company_name;?>">
</div>

<div class="clearfix"></div>
<?php if($company_logo):?>
    <div class="clearfix"></div>
    <img src="<?php echo $company_logo;?>" width="100">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Логотип организации");?></span>
        <input type="file" name="Settings[company_logo]" id="Settings_company_logo" value="<?php echo $company_logo;?>">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text">
    </div>
</div>

<div class="clearfix"></div>

<div class="clearfix"></div>
<?php if($footer_logo):?>
    <div class="clearfix"></div>
    <img src="<?php echo $footer_logo;?>" width="100">
<?php endif;?>
<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Логотип организации в подвале");?></span>
        <input type="file" name="Settings[footer_logo]" id="Settings_footer_logo" value="<?php echo $footer_logo;?>">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text">
    </div>
</div>

<div class="clearfix"></div>


<?php if($company_watermark):?>
    <div class="clearfix"></div>
    <img src="<?php echo $company_watermark;?>" width="100">
<?php endif;?>
<div class="clearfix"></div>
<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Водяной знак для фотографий");?></span>
        <input type="file" name="Settings[company_watermark]" id="Settings_company_watermark" value="<?php echo $company_watermark;?>">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text">
    </div>
</div>
<div class="clearfix"></div>

<div class="input-field col s12 ">
    <label class="active required" for="Settings_company_numbers"><?php echo Yii::t("base","Номера телефонов");?> <span class="required">*</span></label>
    <input class="form-control" name="Settings[company_numbers]" id="Settings_company_numbers" type="text" maxlength="255" value="<?php echo $company_numbers;?>">
</div>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#setting_addr_ru" class="">Русский</a></li>
                <li class="tab col s3"><a class="" href="#setting_addr_ro">Молдавский</a></li>
                <li class="tab col s3"><a href="#setting_addr_en">Английский</a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="setting_addr_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_company_address_ru"><?php echo Yii::t("base","Адрес RU");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[company_address_ru]" id="Settings_company_address_ru" type="text" maxlength="255" value="<?php echo $company_address_ru;?>">
                </div>
            </div>
            <div id="setting_addr_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_company_address_ro"><?php echo Yii::t("base","Адрес RO");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[company_address_ro]" id="Settings_company_address_ro" type="text" maxlength="255" value="<?php echo $company_address_ro;?>">
                </div>
            </div>
            <div id="setting_addr_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_company_address_en"><?php echo Yii::t("base","Адрес EN");?> <span class="required">*</span></label>
                    <input class="form-control" name="Settings[company_address_en]" id="Settings_company_address_en" type="text" maxlength="255" value="<?php echo $company_address_en;?>">
                </div>
            </div>
        </div>
    </li>
</ul>


<div class="input-field col s12 ">
    <label class="active required" for="Settings_company_map"><?php echo Yii::t("base","Координаты на карте");?> <span class="required">*</span></label>
    <input class="form-control" name="Settings[company_map]" id="Settings_company_map" type="text" maxlength="255" value="<?php echo $company_map;?>">
</div>

<div class="input-field col s12 ">
    <label class="active required" for="Settings_company_email"><?php echo Yii::t("base","Адрес электронной почты");?> <span class="required">*</span></label>
    <input class="form-control" name="Settings[company_email]" id="Settings_company_email" type="text" maxlength="255" value="<?php echo $company_email;?>">
</div>

<div class="input-field col s12 ">
    <label class="active required" for="Settings_company_email_resume"><?php echo Yii::t("base","Адрес электронной почты для резюме");?> <span class="required">*</span></label>
    <input class="form-control" name="Settings[company_email_resume]" id="Settings_company_email_resume" type="text" maxlength="255" value="<?php echo $company_email_resume;?>">
</div>

<?php
$keyd = '';
foreach($socials as $key => $social):?>
    <div id="Settings_social_main<?=$key?>">
        <div class="input-field col s12 ">
            <label class="active required" for="Settings_social<?=$key?>"><?php echo Yii::t("base","Ссылка на соц.сеть");?></label>
            <input class="form-control" name="Settings[social<?=$key?>]" id="Settings_social<?=$key?>" type="text" maxlength="255" value="<?= !empty($social['url'])?$social['url']:''?>">
        </div>
        <?php if(!empty($social['logo'])):?>
            <div class="clearfix"></div>
            <img src="<?php echo $social['logo'];?>" width="100">
        <?php endif;?>
        <div class="clearfix"></div>
        <div class="file-field input-field">
            <div onclick="f(<?=$key?>);return false;" style="float: right;">
                ✖
            </div>
            <div class="btn teal lighten-1">
                <span><?php echo Yii::t("base","Логотип Соц.сети");?></span>
                <input type="file" style="width: 90%;" name="Settings[logo_social][<?=$key?>]" id="Settings_logo_social<?=$key?>" value="<?= !empty($social['logo'])?$social['logo']:''?>">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate valid" type="text">
            </div>
        </div>
    </div>
<?php
    $keyd = $key;
endforeach;?>
<div class="clearfix"></div>
<?php $key = count($socials); ?>
<div class="input-field col s12 ">
    <label class="active required" for="Settings_social<?=$key?>"><?php echo Yii::t("base","Ссылка на соц.сеть");?></label>
    <input class="form-control" name="Settings[social<?=$key?>]" id="Settings_social<?=$key?>" type="text" maxlength="255" value="">
</div>
<div class="clearfix"></div>
<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Логотип Соц.сети");?></span>
        <input type="file" name="Settings[logo_social][<?=$key?>]" id="Settings_logo_social<?=$key?>" value="">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text">
    </div>
</div>

<?php $this->widget('booster.widgets.TbButton', array(
    'buttonType'=>'formSubmit',
    'htmlOptions' => array('class' => 'btn btn-success-custom'),
    'label'=> Yii::t("base","Сохранить"),
)); ?>

<?php $this->endWidget(); ?>

<script>
    function f(i){$('#Settings_social_main' + i).remove();}
</script>
