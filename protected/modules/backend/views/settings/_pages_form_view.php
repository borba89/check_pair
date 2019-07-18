<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'settings-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
));
?>
<!--<div class="input-field col s12 ">-->
<!--    <textarea id="textarea1" name="Settings[text]" class="materialize-textarea"></textarea>-->
<!--    <label for="textarea1">Textarea</label>-->
<!--</div>-->

<p style="margin-bottom: 30px;"></p>
<div class="clearfix"></div>

<div class="col s4">
    <img src="<?php echo $bg_slider;?>" style="width: 100%; max-width: 230px;">
</div>
<div class="col s8">
    <?php
//    if ( !is_file($bg_slider)) {
//        //Убираем первый / иначе не видит файл
//        $bg_slider_sub = substr($bg_slider, 1);
//        $image_info = getimagesize($bg_slider_sub);
//        echo $image_info[0].' х '.$image_info[1];
//        echo '1600 х 750';
//    }
    ?>
    1600х750 px
</div>

<div class="clearfix"></div>

<div class="file-field input-field">
    <div class="btn teal lighten-1">
        <span><?php echo Yii::t("base","Фон слайдера на главной");?></span>
        <input type="file" name="Settings[bg_slider]" id="Settings_bg_slider" value="<?php echo $bg_slider;?>">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate valid" type="text" value="<?php echo $bg_slider;?>">
    </div>
</div>
<div class="clearfix"></div>

<?php if (0): ?>
<!--<div class="input-field col s12 ">-->
<!--    <label class="active required" for="Settings_slider_numbers">--><?php //echo Yii::t("base","Количество слайдов на главной");?><!-- <span class="required">*</span></label>-->
<!--    <input class="form-control" name="Settings[slider_numbers]" id="Settings_slider_numbers" type="text" maxlength="255" value="--><?php //echo $slider_numbers;?><!--">-->
<!--</div>-->
<?php endif ?>

<div class="input-field col s12 ">
    <a class="waves-effect waves-light btn m-b-xs" href="<?php echo Yii::app()->createUrl('/backend/slider/admin');?>"><?php echo Yii::t('InfoModule.info', 'Управление слайдами на главной');?></a>
</div>


<!-- Настройки блока объявлений на главной -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Блок объявлений')?></h5>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#featured_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#featured_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#featured_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="featured_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_featured_ru"><?php echo Yii::t("base","Заголовок блока объявлений RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_featured_ru]" id="Settings_title_featured_ru" type="text" maxlength="255"><?php echo $title_featured_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_featured_ru"><?php echo Yii::t("base","Подзаголовок блока объявлений RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_featured_ru]" id="Settings_subtitle_featured_ru" type="text" maxlength="255"><?php echo $subtitle_featured_ru;?></textarea>
                </div>
            </div>
            <div id="featured_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_featured_ro"><?php echo Yii::t("base","Заголовок блока объявлений RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_featured_ro]" id="Settings_title_featured_ro" type="text" maxlength="255"><?php echo $title_featured_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_featured_ro"><?php echo Yii::t("base","Подзаголовок блока объявлений RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_featured_ro]" id="Settings_subtitle_featured_ro" type="text" maxlength="255"><?php echo $subtitle_featured_ro;?></textarea>
                </div>
            </div>
            <div id="featured_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_featured_en"><?php echo Yii::t("base","Заголовок блока объявлений EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_featured_en]" id="Settings_title_featured_en" type="text" maxlength="255"><?php echo $title_featured_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_featured_en"><?php echo Yii::t("base","Подзаголовок блока объявлений EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_featured_en]" id="Settings_subtitle_featured_en" type="text" maxlength="255"><?php echo $subtitle_featured_en;?></textarea>
                </div>
            </div>
        </div>
    </li>
</ul>

<!-- Настройки блока типы недвижимости на главной -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Блок Типы недвижимости')?></h5>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#lookup_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#lookup_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#lookup_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="lookup_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_lookup_ru"><?php echo Yii::t("base","Заголовок блока Типы недвижимости RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_lookup_ru]" id="Settings_title_lookup_ru" type="text" maxlength="255"><?php echo $title_lookup_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_lookup_ru"><?php echo Yii::t("base","Подзаголовок блока Типы недвижимости RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_lookup_ru]" id="Settings_subtitle_lookup_ru" type="text" maxlength="255"><?php echo $subtitle_lookup_ru;?></textarea>
                </div>
            </div>
            <div id="lookup_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_lookup_ro"><?php echo Yii::t("base","Заголовок блока Типы недвижимости RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_lookup_ro]" id="Settings_title_lookup_ro" type="text" maxlength="255"><?php echo $title_lookup_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_lookup_ro"><?php echo Yii::t("base","Подзаголовок блока Типы недвижимости RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_lookup_ro]" id="Settings_subtitle_lookup_ro" type="text" maxlength="255"><?php echo $subtitle_lookup_ro;?></textarea>
                </div>
            </div>
            <div id="lookup_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_lookup_en"><?php echo Yii::t("base","Заголовок блока Типы недвижимости EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_lookup_en]" id="Settings_title_lookup_en" type="text" maxlength="255"><?php echo $title_lookup_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_lookup_en"><?php echo Yii::t("base","Подзаголовок блока Типы недвижимости EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_lookup_en]" id="Settings_subtitle_lookup_en" type="text" maxlength="255"><?php echo $subtitle_lookup_en;?></textarea>
                </div>
            </div>
        </div>

        <div class="input-field col s12 ">
            <a class="waves-effect waves-light btn m-b-xs" href="<?php echo Yii::app()->createUrl('/backend/contentBlock/adminRealty');?>"><?php echo Yii::t('InfoModule.info', 'Управление типами недвижимости');?></a>
        </div>
    </li>
</ul>

<!-- Настройки блока Недавно просмотренные на главной -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Блок Недавно просмотренные')?></h5>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#recently_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#recently_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#recently_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="recently_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_recently_ru"><?php echo Yii::t("base","Заголовок блока Последние просмотренные RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_recently_ru]" id="Settings_title_recently_ru" type="text" maxlength="255"><?php echo $title_recently_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_recently_ru"><?php echo Yii::t("base","Подзаголовок блока Последние просмотренные RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_recently_ru]" id="Settings_subtitle_recently_ru" type="text" maxlength="255"><?php echo $subtitle_recently_ru;?></textarea>
                </div>
            </div>
            <div id="recently_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_recently_ro"><?php echo Yii::t("base","Заголовок блока Последние просмотренные RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_recently_ro]" id="Settings_title_recently_ro" type="text" maxlength="255"><?php echo $title_recently_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_recently_ro"><?php echo Yii::t("base","Подзаголовок блока Последние просмотренные RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_recently_ro]" id="Settings_subtitle_recently_ro" type="text" maxlength="255"><?php echo $subtitle_recently_ro;?></textarea>
                </div>
            </div>
            <div id="recently_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_recently_en"><?php echo Yii::t("base","Заголовок блока Последние просмотренные EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_recently_en]" id="Settings_title_recently_en" type="text" maxlength="255"><?php echo $title_recently_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_recently_en"><?php echo Yii::t("base","Подзаголовок блока Последние просмотренные EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_recently_en]" id="Settings_subtitle_recently_en" type="text" maxlength="255"><?php echo $subtitle_recently_en;?></textarea>
                </div>
            </div>
        </div>
    </li>
</ul>


<!-- Настройки блока What our client say на главной -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Видео')?></h5>
<div class="collection-item">
    <p class="green-text text-darken-4"><?php $client_say_video;?></p>
    <div class="file-field input-field">
        <div class="btn teal lighten-1" id="id_input_client_say_video">
            <span class=""><?php echo Yii::t("base","Файл видео");?></span>
            <input style="width: 0px;" type="file" name="Settings[client_say_video]" id="Settings_client_say_video" value="<?php echo $client_say_video;?>">
        </div>
        <div class="file-path-wrapper">
<!--            <input class="file-path validate valid" type="text" value="--><?php //echo $web_client_say_video;?><!--">-->
            <label class="active required" for="Settings_web_client_say_video"><?php echo Yii::t("base","Ссылка видео");?></label>
            <input type="text" class="file-path validate valid" name="Settings[web_client_say_video]" id="Settings_web_client_say_video" value="<?php echo $client_say_video;?>">
        </div>

    </div>
    <div class="clearfix"></div>
    <div style="padding: 0 0.75rem;">
    <div class="col s4">
        <img src="<?php echo $client_say_video_preview;?>" style="width: 100%; max-width: 215px;">
    </div>
    <div class="col s8">
        1600х395 px
    </div>

    <div class="clearfix"></div>
    <div class="file-field input-field">
        <div class="btn teal lighten-1">
            <span><?php echo Yii::t("base","Изображение - превью");?></span>
            <input type="file" name="Settings[client_say_video_preview]" id="Settings_client_say_video_preview" value="<?php echo $client_say_video_preview;?>">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate valid" type="text" value="<?php echo $client_say_video_preview;?>">
        </div>
    </div>
    </div>
</div>
<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#client_say_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#client_say_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#client_say_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="client_say_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_client_say_ru"><?php echo Yii::t("base","Заголовок блока Отзывы клиентов RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_client_say_ru]" id="Settings_title_client_say_ru" type="text" maxlength="255"><?php echo $title_client_say_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_client_say_ru"><?php echo Yii::t("base","Подзаголовок блока Отзывы клиентов RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_client_say_ru]" id="Settings_subtitle_client_say_ru" type="text" maxlength="255"><?php echo $subtitle_client_say_ru;?></textarea>
                </div>
            </div>
            <div id="client_say_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_client_say_ro"><?php echo Yii::t("base","Заголовок блока Отзывы клиентов RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_client_say_ro]" id="Settings_title_client_say_ro" type="text" maxlength="255"><?php echo $title_client_say_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_client_say_ro"><?php echo Yii::t("base","Подзаголовок блока Отзывы клиентов RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_client_say_ro]" id="Settings_subtitle_client_say_ro" type="text" maxlength="255"><?php echo $subtitle_client_say_ro;?></textarea>
                </div>
            </div>
            <div id="client_say_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_client_say_en"><?php echo Yii::t("base","Заголовок блока Отзывы клиентов EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_client_say_en]" id="Settings_title_client_say_en" type="text" maxlength="255"><?php echo $title_client_say_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_subtitle_client_say_en"><?php echo Yii::t("base","Подзаголовок блока Отзывы клиентов EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[subtitle_client_say_en]" id="Settings_subtitle_client_say_en" type="text" maxlength="255"><?php echo $subtitle_client_say_en;?></textarea>
                </div>
            </div>
        </div>
    </li>
</ul>


<!-- Настройки блока Our brand & patners -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Партнёры')?></h5>

<ul class="collection">
    <li class="collection-item">
        <?php if (0): ?>
<!--        <div class="input-field col s12 ">-->
<!--            <label class="active required" for="Settings_count_partners">--><?php //echo Yii::t("base","Количество элементов в блоке Партнёры");?><!-- <span class="required">*</span></label>-->
<!--            <input class="form-control" name="Settings[count_partners]" id="Settings_count_partners" type="text" maxlength="255" value="--><?php //echo $count_partners;?><!--">-->
<!--        </div>-->
        <?php endif; ?>
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#title_partners_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#title_partners_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#title_partners_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="title_partners_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_partners_ru"><?php echo Yii::t("base","Заголовок блока Партнёры  RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_partners_ru]" id="Settings_title_partners_ru" type="text" maxlength="255"><?php echo $title_partners_ru;?></textarea>
                </div>
            </div>
            <div id="title_partners_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_partners_ro"><?php echo Yii::t("base","Заголовок блока Партнёры RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_partners_ro]" id="Settings_title_partners_ro" type="text" maxlength="255"><?php echo $title_partners_ro;?></textarea>
                </div>
            </div>
            <div id="title_partners_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_partners_en"><?php echo Yii::t("base","Заголовок блока Партнёры EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_partners_en]" id="Settings_title_partners_en" type="text" maxlength="255"><?php echo $title_partners_en;?></textarea>
                </div>
            </div>
        </div>

        <div class="input-field col s12 ">
            <a class="waves-effect waves-light btn m-b-xs" href="<?php echo Yii::app()->createUrl('/backend/contentBlock/adminPartners');?>"><?php echo Yii::t('InfoModule.info', 'Управление партнёрами');?></a>
        </div>

    </li>
</ul>

<!-- Настройки блока Подвала -->
<div class="clearfix"></div>
<h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Подвал')?></h5>

<ul class="collection">
    <li class="collection-item">
        <div class="col s12">
            <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                <li class="tab col s3"><a href="#footer_text_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                <li class="tab col s3"><a class="" href="#footer_text_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                <li class="tab col s3"><a href="#footer_text_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                <div class="indicator" style="right: 0px; left: 397.5px;"></div>
            </ul>
            <p class="clearfix" style="height: 10px;"></p>
            <div id="footer_text_ru" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_footer_text_ru"><?php echo Yii::t("base","Текст подвала RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[footer_text_ru]" id="Settings_footer_text_ru" type="text" maxlength="255"><?php echo $footer_text_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_useful_links_ru"><?php echo Yii::t("base","Заголовок для блока Ссылок подвала RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[useful_links_ru]" id="Settings_useful_links_ru" type="text" maxlength="255"><?php echo $useful_links_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_contact_us_ru"><?php echo Yii::t("base","Заголовок для блока Контакты подвала RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[contact_us_ru]" id="Settings_contact_us_ru" type="text" maxlength="255"><?php echo $contact_us_ru;?></textarea>
                </div>

                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_subscribe_ru"><?php echo Yii::t("base","Заголовок для блока Подписывайся подвала RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_subscribe_ru]" id="Settings_title_subscribe_ru" type="text" maxlength="255"><?php echo $title_subscribe_ru;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_text_subscribe_ru"><?php echo Yii::t("base","Подсказка для блока Контакты подвала RU");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[text_subscribe_ru]" id="Settings_text_subscribe_ru" type="text" maxlength="255"><?php echo $text_subscribe_ru;?></textarea>
                </div>
            </div>
            <div id="footer_text_ro" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_footer_text_ro"><?php echo Yii::t("base","Текст подвала RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[footer_text_ro]" id="Settings_footer_text_ro" type="text" maxlength="255"><?php echo $footer_text_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_useful_links_ro"><?php echo Yii::t("base","Заголовок для блока Ссылок подвала RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[useful_links_ro]" id="Settings_useful_links_ro" type="text" maxlength="255"><?php echo $useful_links_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_contact_us_ro"><?php echo Yii::t("base","Заголовок для блока Контакты подвала RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[contact_us_ro]" id="Settings_contact_us_ro" type="text" maxlength="255"><?php echo $contact_us_ro;?></textarea>
                </div>

                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_subscribe_ro"><?php echo Yii::t("base","Заголовок для блока Подписывайся подвала RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_subscribe_ro]" id="Settings_title_subscribe_ro" type="text" maxlength="255"><?php echo $title_subscribe_ro;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_text_subscribe_ro"><?php echo Yii::t("base","Подсказка для блока Контакты подвала RO");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[text_subscribe_ro]" id="Settings_text_subscribe_ro" type="text" maxlength="255"><?php echo $text_subscribe_ro;?></textarea>
                </div>
            </div>
            <div id="footer_text_en" class="col s12">
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_footer_text_en"><?php echo Yii::t("base","Текст подвала EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[footer_text_en]" id="Settings_footer_text_en" type="text" maxlength="255"><?php echo $footer_text_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_useful_links_en"><?php echo Yii::t("base","Заголовок для блока Ссылок подвала EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[useful_links_en]" id="Settings_useful_links_en" type="text" maxlength="255"><?php echo $useful_links_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_contact_us_en"><?php echo Yii::t("base","Заголовок для блока Контакты подвала EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[contact_us_en]" id="Settings_contact_us_en" type="text" maxlength="255"><?php echo $contact_us_en;?></textarea>
                </div>

                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_title_subscribe_en"><?php echo Yii::t("base","Заголовок для блока Подписывайся подвала EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[title_subscribe_en]" id="Settings_title_subscribe_en" type="text" maxlength="255"><?php echo $title_subscribe_en;?></textarea>
                </div>
                <div class="input-field col s12 ">
                    <label class="active required" for="Settings_text_subscribe_en"><?php echo Yii::t("base","Подсказка для блока Контакты подвала EN");?> <span class="required">*</span></label>
                    <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[text_subscribe_en]" id="Settings_text_subscribe_en" type="text" maxlength="255"><?php echo $text_subscribe_en;?></textarea>
                </div>
            </div>
        </div>
    </li>
</ul>

    <!-- Настройки блока SEO -->
    <div class="clearfix"></div>
    <h5 class="card-title"><?php echo Yii::t('BackendModule.backend', 'Настройка SEO')?></h5>

    <ul class="collection">
        <li class="collection-item">
            <div class="col s12">
                <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                    <li class="tab col s3"><a href="#meta_title_ru" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                    <li class="tab col s3"><a class="" href="#meta_title_ro"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                    <li class="tab col s3"><a href="#meta_title_en"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                    <div class="indicator" style="right: 0px; left: 397.5px;"></div>
                </ul>
                <p class="clearfix" style="height: 10px;"></p>
                <div id="meta_title_ru" class="col s12">
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_title_ru"><?php echo Yii::t("base","Мета заголовок RU");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_title_ru]" id="Settings_meta_title_ru" type="text" maxlength="100"><?php echo $meta_title_ru;?></textarea>
                    </div>
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_description_ru"><?php echo Yii::t("base","Мета описание RU");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_description_ru]" id="Settings_meta_description_ru" type="text" maxlength="160"><?php echo $meta_description_ru;?></textarea>
                    </div>
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_keywords_ru"><?php echo Yii::t("base","Ключевые слова RU");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_keywords_ru]" id="Settings_meta_keywords_ru" type="text" maxlength="200"><?php echo $meta_keywords_ru;?></textarea>
                    </div>
                </div>
                <div id="meta_title_ro" class="col s12">
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_title_ro"><?php echo Yii::t("base","Мета заголовок RO");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_title_ro]" id="Settings_meta_title_ro" type="text" maxlength="100"><?php echo $meta_title_ro;?></textarea>
                    </div>
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_description_ro"><?php echo Yii::t("base","Мета описание RO");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_description_ro]" id="Settings_meta_description_ro" type="text" maxlength="160"><?php echo $meta_description_ro;?></textarea>
                    </div>
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_keywords_ro"><?php echo Yii::t("base","Ключевые слова RO");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_keywords_ro]" id="Settings_meta_keywords_ro" type="text" maxlength="200"><?php echo $meta_keywords_ro;?></textarea>
                    </div>
                </div>
                <div id="meta_title_en" class="col s12">
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_title_en"><?php echo Yii::t("base","Мета заголовок EN");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_title_en]" id="Settings_meta_title_en" type="text" maxlength="100"><?php echo $meta_title_en;?></textarea>
                    </div>
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_description_en"><?php echo Yii::t("base","Мета описание EN");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_description_en]" id="Settings_meta_description_en" type="text" maxlength="160"><?php echo $meta_description_en;?></textarea>
                    </div>
                    <div class="input-field col s12 ">
                        <label class="active required" for="Settings_meta_keywords_en"><?php echo Yii::t("base","Ключевые слова EN");?> <span class="required">*</span></label>
                        <textarea class="form-control materialize-textarea textarea-like-input" name="Settings[meta_keywords_en]" id="Settings_meta_keywords_en" type="text" maxlength="200"><?php echo $meta_keywords_en;?></textarea>
                    </div>
                </div>
            </div>
        </li>
    </ul>

<?php $this->widget('booster.widgets.TbButton', array(
    'buttonType'=>'formSubmit',
    'htmlOptions' => array('class' => 'btn btn-success-custom'),
    'label'=> Yii::t("base","Сохранить"),
)); ?>

<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript('input_client_say_video', "
    $('#Settings_client_say_video').css('width', document.getElementById('id_input_client_say_video').scrollWidth);
", CClientScript::POS_READY); ?>