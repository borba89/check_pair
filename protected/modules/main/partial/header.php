<header>
    <div id="top-menu" class="pt-1em">
        <div class="container">
            <div class="flex space-between items-center">
                <div class="pb-1em logo-block">
                    <a href="<?php echo Yii::app()->homeUrl; ?>">
                        <img src="<?php echo Yii::app()->getModule('main')->assetsUrl; ?>/img/logo-moldrealty.png" alt="">
                    </a>
                </div>
                <div class="hover-menu pl-3em-md pr-3em-md pl-5em-lg pr-5em-lg pb-1em">
                    <div class="size-1_5em up cur-def">
                        <?php echo Yii::t("MainModule.main", "Недвижимость по лучшим ценам!"); ?>
                    </div>
                    <?php $this->widget('main.widgets.Menu', array(
                        'htmlOptions' => array(
                            'class' => 'display-none-xs flex space-between up m-auto max-width-30em',
                        ),
                        'items'=>array(
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            array(
                                'label'=> Yii::t("MainModule.main", 'аренда'),
                                'url' => array('/offer/front', 'param' => RealtyOffer::RENT),
                                'itemOptions' => array('class' => "size-0_9em")
                            ),
                            array(
                                'label'=> Yii::t("MainModule.main", 'покупка'),
                                'url' => array('/info/front'),
                                'itemOptions' => array('class' => "size-0_9em")
                            ),
                            array(
                                'label'=> Yii::t("MainModule.main", 'продажа'),
                                'url' => array('/offer/front/sale'),
                                'itemOptions' => array('class' => "size-0_9em")
                            ),
                            array(
                                'label'=> Yii::t("MainModule.main", 'B2B'),
                                'url' => array('/info/front'),
                                'itemOptions' => array('class' => "size-0_9em")
                            ),
                        ),
                    )); ?>
                </div>
                <div class="col-xs-12 pb-2em-xs text-center pb-1em call-block display-none-sm">
                    <a class="display-inline-block" href="tel:+1800229933">
                        <div class="flex-0_5em items-center hover-red">
                            <div><em class="c-green fa fa-mobile size-4em lh-0_8em" aria-hidden="true"></em></div>
                            <div class="mt--0_3em">
                                <div class="up">
                                    <?php echo Yii::t("MainModule.main", "Звоните прямо сейчас"); ?>!
                                </div>
                                <div class="size-1_8em lh-1em">+373 69131313</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="pb-2em-xs text-center pb-1em call-block display-none-xs display-block-sm">
                    <a class="display-inline-block" href="<?php echo $this->createUrl('/main/default/contact'); ?>">
                        <div class="flex-0_5em items-center hover-red">
                            <div><em class="c-green fa fa-mobile size-4em lh-0_8em" aria-hidden="true"></em></div>
                            <div class="mt--0_3em">
                                <div class="up">
                                    <?php echo Yii::t("MainModule.main", "Звоните прямо сейчас"); ?>!
                                </div>
                                <div class="size-1_8em lh-1em">+373 69131313</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="main-menu">
        <?php $this->widget('main.widgets.Menu', array(
            'htmlOptions' => array('class' => 'submenu'),
            'outTag' => 'ul',
            'itemTag' => 'li',
            'items'=>array(
                // Important: you need to specify url as 'controller/action',
                // not just as 'controller' even if default action is used.
                array(
                    'label' => Yii::t("MainModule.main", 'ГЛАВНАЯ'),
                    'url' => array('/main/default/index'),
                    'itemOptions' => array('class' => "size-0_9em")
                ),
                array(
                    'label' => Yii::t("MainModule.main", 'РЕЕСТР НЕДВИЖИМОСТИ'),
                    'url' => array('/offer/front'),
                    'itemOptions' => array('class' => "size-0_9em")
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'ВАШЕ ИЗБРАННОЕ'),
                    'url'=>array('/offer/front/favorite'),
                    'itemOptions' => array('class' => "size-0_9em")
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'НОВОСТИ РЫНКА'),
                    'url'=>array('/blog/front'),
                    'itemOptions' => array('class' => "size-0_9em")
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'УСЛУГИ АГЕНСТВА'),
                    'url'=>array('/info/front'),
                    'itemOptions' => array('class' => "size-0_9em")
                ),
                array(
                    'label'=> Yii::t("base", 'НАШИ КОНТАКТЫ'),
                    'url'=>array('/main/default/contact'),
                    'itemOptions' => array('class' => "size-0_9em")
                ),
            ),
        )); ?>
    </div>
    <div>
        <?php $this->widget('main.widgets.Menu', array(
            'htmlOptions' => array('class' => 'side-nav pt-2em', 'id' => 'slide-out'),
            'outTag' => 'ul',
            'itemTag' => 'li',
            'activeCssClass' => 'current',
            'items'=>array(
                // Important: you need to specify url as 'controller/action',
                // not just as 'controller' even if default action is used.
                array(
                    'template' => '<li class="mobile-logo">
                        <a href="' . Yii::app()->homeUrl .'">
                            '. CHtml::image(Yii::app()->getModule('main')->assetsUrl . '/img/logo-moldrealty.png') .'
                        </a>
                    </li>',
                ),
                array(
                    'label' => Yii::t("MainModule.main", 'ГЛАВНАЯ'),
                    'url' => array('/main/default/index'),
                ),
                array(
                    'label' => Yii::t("MainModule.main", 'РЕЕСТР НЕДВИЖИМОСТИ'),
                    'url' => array('/offer/front/index'),
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'ВАШЕ ИЗБРАННОЕ'),
                    'url'=>array('/offer/front/favorite'),
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'НОВОСТИ РЫНКА'),
                    'url'=>array('/blog/front/index'),
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'УСЛУГИ АГЕНСТВА'),
                    'url'=>array('/info/front/index'),
                ),
                array(
                    'label'=> Yii::t("base", 'НАШИ КОНТАКТЫ'),
                    'url'=>array('/main/default/contact'),
                ),
                array(
                    'template'=> '<li><div class="divider"></div></li>',
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'аренда'),
                    'url' => array('/offer/front/index', 'param' => RealtyOffer::RENT),
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'покупка'),
                    'url' => array('/info/front/index'),
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'продажа'),
                    'url' => array('/offer/front/sale'),
                ),
                array(
                    'label'=> Yii::t("MainModule.main", 'B2B'),
                    'url' => array('/info/front/index'),
                ),
                array(
                    'template'=> '<li><div class="divider"></div></li>',
                ),
                array(
                    'template'=> '<li>' . $this->widget('MultiLang', array('mobile' => true), true) . '</li>',
                ),
            ),
        )); ?>
        <a href="#" data-activates="slide-out" class="button-collapse display-none-xs display-block-sm display-none-md"><i class="fa fa-bars" aria-hidden="true"></i></a>
    </div>
</header>