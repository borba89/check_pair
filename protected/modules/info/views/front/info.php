<div class="main">
    <div id="p_prldr">
        <div class="contpre">
            <span class="svg_anm"></span>
        </div>
    </div>
    <section>
        <div class="owl-carousel owl-theme bx-shadow-1" id="service-slider">
            <div class="item" style="background: url('<?php echo Yii::app()->getModule('main')->assetsUrl; ?>/img/services/services-slider.jpg') no-repeat center bottom / cover">
                <div class="container">
                    <div class="flex center pt-4em pb-4em">
                        <div class="col-xs-10 col-sm-8">
                            <div>
                                <h1 class="up f-bold c-white"><?php echo Yii::t("base", "{sitename} [br] Лучшие среди профессионалов", array('{sitename}' => Yii::app()->name, '[br]' => '<br>'));?></h1>
                            </div>
                            <div class="pb-2em">
                                <p class="h4 c-white f-light"><?php echo Yii::t("InfoModule.info", "Любые услуги по управлению, покупке, продаже, оценке [br]недвижимости - [br] дома, квартиры, офисы, земельные участки, [br]коммерческая недвижимость, складские и производственные", array('[br]' => '<br>'));?>
                                </p>
                            </div>
                            <div>
                                <a href="#" class="up button-medium button-green width-12em-sm"><em class="fa fa-search" aria-hidden="true"></em> <?php echo Yii::t("InfoModule.info", "Узнать больше");?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if ($infoblocks) { ?>
        <?php foreach ($infoblocks as $key => $infoblock) { ?>
            <?php if ($key > 0) { ?>
                <section class="pt-5em pb-5em text-center parallax-window" data-parallax="scroll" data-image-src="<?php echo Yii::app()->getModule('main')->assetsUrl.'/'.$infoblock->getMiddleImage($key); ?>">
                    <h2 class="up f-bold c-white"><?php echo Yii::t("InfoModule.info", "оценка недвижимости");?></h2>
                </section>
            <?php } ?>
            <section class="pt-3em pb-3em">
                <div class="container">
                    <div class="flex-0_5em items-center">
                        <div class="col-xs-12 col-sm-4">
                            <div class="bc-green mb-1em pl-1_5em pr-1_5em pt-0_5em pb-0_5em">
                                <div class="up c-white h4 lh-1_1em"><?php echo $infoblock->title; ?></div>
                            </div>
                            <div class="mb-0_5em">
                                <a href="#">
                                    <div class="scale-img-parent">
                                        <img class="w100 scale-out-img" src="/<?php echo $infoblock->image; ?>" alt="">
                                        <div class="image-links">
                                            <div class="block-center">
                                                <a class="link-inner" href="news-single.html">
                                                    <em class="fa fa-link" aria-hidden="true"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <div class="pt-1em pb-1_4em">
                                <blockquote class="h6 f-light">
                                    <?php echo $infoblock->text; ?>
                                </blockquote>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo $this->createUrl('/main/default/contact'); ?>" class="button-medium button-red width-13em phone-parent">
                                    <em class="fa fa-mobile phone-more" aria-hidden="true"></em>
                                    <?php echo Yii::t("InfoModule.info", "связаться");?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
</div>