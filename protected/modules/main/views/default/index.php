<div class="main size-0_8em-sm size-1em-md">
    <div id="p_prldr">
        <div class="contpre">
            <span class="svg_anm"></span>
        </div>
    </div>
    <?php $this->widget('main.widgets.SliderWidget'); ?>
    <div class="pt-3em pb-3em-md">
        <div class="container">
            <div class="flex-2em child-mb-3em-xs">
                <div class="col-xs-12 col-sm-4">
                    <div class="bc-green text-center mb-1em cur-def">
                        <div class="up c-white size-1_6em"><?php echo Yii::t("MainModule.main", "Новости рынка");?></div>
                    </div>
                    <div class="mb-0_5em">
                        <a href="<?php echo $this->createUrl('/offer/front'); ?>">
                            <div class="scale-img-parent">
                                <img class="scale-out-img" src="<?php echo $this->module->assetsUrl; ?>/img/item-1.jpg" alt="news-post">
                                <div class="image-links">
                                    <div class="block-center">
                                        <span class="link-inner">
                                            <em class="fa fa-list-ul" aria-hidden="true"></em>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <blockquote>
                            <?php echo Yii::t("MainModule.main", "Мы внимательно следим за тем, что происходит на рынке недвижимости в Молдавии, и делимся этой информацией в нашем блоге");?>
                        </blockquote>
                    </div>
                    <div class="text-center-xs display-none-sm">
                        <a href="<?php echo $this->createUrl('/offer/front'); ?>" class="button-medium button-green">
                            <?php echo Yii::t("MainModule.main", "подробнее");?>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="bc-green text-center mb-1em cur-def">
                        <div class="up c-white size-1_6em">
                            <?php echo Yii::t("MainModule.main", "Услуги компании");?>
                        </div>
                    </div>
                    <div class="mb-0_5em">
                        <a href="<?php echo $this->createUrl('/info/front/index'); ?>">
                            <div class="scale-img-parent">
                                <img class="scale-out-img" src="<?php echo $this->module->assetsUrl; ?>/img/item-2.jpg" alt="news-post">
                                <div class="image-links">
                                    <div class="block-center">
                                        <span class="link-inner">
                                            <em class="fa fa-list-ul" aria-hidden="true"></em>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <blockquote>
                            <?php echo Yii::t("MainModule.main", "Риэлторская компания New Door Realty на самом высоком уровне предоставляет любые услуг, связанные с недвижимостью");?>
                        </blockquote>
                    </div>
                    <div class="text-center-xs display-none-sm">
                        <a href="<?php echo $this->createUrl('/info/front/index'); ?>" class="button-medium button-green">
                            <?php echo Yii::t("MainModule.main", "подробнее");?>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="bc-green text-center mb-1em cur-def">
                        <div class="up c-white size-1_6em">
                            <?php echo Yii::t("MainModule.main", "наши контакты");?>
                        </div>
                    </div>
                    <div class="mb-0_5em">
                        <a href="<?php echo $this->createUrl('/main/default/contact'); ?>">
                            <div class="scale-img-parent">
                                <img class="scale-out-img" src="<?php echo $this->module->assetsUrl; ?>/img/item-3.jpg" alt="news-post">
                                <div class="image-links">
                                    <div class="block-center">
                                        <span class="link-inner">
                                            <em class="fa fa-list-ul" aria-hidden="true"></em>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <blockquote>
                            <?php echo Yii::t("MainModule.main", "Мы будем рады видеть Вас в нашем офисе по адресу, Кишинёв, ул. В. Александри 143, 2-ой этаж, по будним дням и в субботу");?>
                        </blockquote>
                    </div>
                    <div class="text-center-xs display-none-sm">
                        <a href="<?php echo $this->createUrl('/main/default/contact'); ?>" class="button-medium button-green">
                            <?php echo Yii::t("MainModule.main", "подробнее");?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>