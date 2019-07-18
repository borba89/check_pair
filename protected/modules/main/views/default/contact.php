<div class="main">
    <div id="p_prldr">
        <div class="contpre">
            <span class="svg_anm"></span>
        </div>
    </div>
    <section class="w100 text-center up c-white pt-4_5em pb-6em mb-3em bx-shadow-1 parallax-window load-background" data-parallax="scroll" data-image-src="<?php echo Yii::app()->getModule('main')->assetsUrl; ?>/img/bg/dom.jpg">
        <div class="pl-1em-xs pr-1em-xs">
            <h3 class="f-medium ls-0_03em">
                <?php echo Yii::t("MainModule.main", "АГЕНТСТВО {sitename}",
                    array('{sitename}' => Yii::app()->name));?>
            </h3>
            <h5 class="ls-0_03em"><?php echo Yii::t("MainModule.main", "Ваш надёжный партнёр на рынке недвижимости");?></h5>
        </div>
    </section>
    <section>
        <div class="container-1260">
            <div class="article flex-1em mb-3em no-wrap-sm wrap-xs pb-1_5em">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="bc-green p-1em mb-1_3em">
                        <div class="h5 c-white up ls-0_03em"><?php echo Yii::t("MainModule.main", "Наш адрес");?>:</div>
                        <div class="size-1_1em f-light c-white ls-0_03em">
                            <?php echo Yii::t("MainModule.main", "Мун. Кишинэу, ул. Василе Александри 143, 2 этаж");?>
                        </div>
                    </div>
                    <div class="scale-img-parent">
                        <img class="scale-out-img" src="<?php echo Yii::app()->getModule('main')->assetsUrl; ?>/img/news/news-post.jpg" alt="news-post">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="pl-1em pr-1em mb-1_3em pt-4em hover-red">
                        <div class="h5 up ls-0_03em"><?php echo Yii::t("MainModule.main", "Контакты");?>:</div>
                    </div>
                    <div class="pl-1em pr-1em mb-1em hover-red">
                        <div class="pl-2em phone-icon size-1_4em up f-medium"><?php echo Yii::t("MainModule.main", "Телефон");?>:</div>
                        <div class="f-light pl-2em size-1_4em"><a href="tel:+37368860955">+ 373 78994409</a></div>
                        <div class="f-light pl-2em size-1_4em"><a href="tel:+37368860955">+ 373 78899699</a></div>
                    </div>
                    <div class="pl-1em pr-1em hover-red">
                        <div class="pl-2em mail-icon size-1_4em up f-medium">Email:</div>
                        <div class="f-light pl-2em size-1_4em"><a href="mailto:info@moldrealty.md">info@moldrealty.md</a></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="pl-1em pr-1em mb-1_3em pt-4em hover-red">
                        <div class="h5 up ls-0_03em"><?php echo Yii::t("MainModule.main", "график работы");?>:</div>
                    </div>
                    <div class="pl-1em pr-1em mb-1em hover-red">
                        <div class="size-1_4em up f-medium"><?php echo Yii::t("MainModule.main", "Будни");?>:</div>
                        <div class="f-light size-1_4em">9:00 - 19:00</div>
                    </div>
                    <div class="pl-1em pr-1em mb-1em hover-red">
                        <div class="size-1_4em up f-medium"><?php echo Yii::t("MainModule.main", "суббота");?>:</div>
                        <div class="f-light size-1_4em">10:00 - 14:00</div>
                    </div>
                    <div class="pl-1em pr-1em mb-1em hover-red">
                        <div class="size-1_4em up f-medium"><?php echo Yii::t("MainModule.main", "Воскресенье");?>:</div>
                        <div class="f-light size-1_4em"><?php echo Yii::t("MainModule.main", "Выходной");?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-1em">
        <div class="container-1260">
            <div class="w100 text-center pb-2em">
                <h5 class="ls-0_03em"><?php echo Yii::t("MainModule.main", "СХЕМА ПРОЕЗДА К ОФИСУ АГЕНТСТВА НЕДВИЖИМОСТИ");?></h5>
            </div>
            <div id="map" class="w100 height-33em">

            </div>
        </div>
    </section>
</div>

<?php Yii::app()->clientScript->registerScriptFile('//maps.googleapis.com/maps/api/js?key=AIzaSyB2N9SojBJmCY8H30GBGqhpqu7YKlRBBnk&amp;&callback=initMap', CClientScript::POS_END); ?>