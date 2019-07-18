<?php
    $realtyDetailed = $realtyOffer->realty->realtyDetailed;
    $additionalInfo = ($realtyDetailed)?$realtyDetailed->viewAdditional():null;
?>
<div class="main">
    <div id="p_prldr">
        <div class="contpre">
            <span class="svg_anm"></span>
        </div>
    </div>
    <?php $this->widget('main.widgets.SliderWidget', array('model' => $realtyOffer)); ?>
    <div class="container-1260">
        <div class="article flex space-between mb-3em no-wrap-sm wrap-xs pb-1_5em">
            <div class="pl-1_5em-sm col-sm-12 col-md-8 pt-2em-xs">
                <div class="size-1_2em p-1em pt-2em pr-3em-lg">
                    <p><?php echo $realtyOffer->realty->description; ?></p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 p-2em ">
                <div class="flex column bc-green c-white up pl-1em pr-1em text-center dashed-border">
                    <?php if ($additionalInfo) { ?>
                        <?php foreach ($additionalInfo as $info) { ?>
                            <?php if (@$info['name'] == 'newly_built') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        <?php echo $realtyDetailed->newlyBuildLabel(); ?>
                                    </h5>
                                </div>
                            <?php } elseif (@$info['name'] == 'space_conditions') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        "<?php echo $realtyDetailed->getSpaseConditions($realtyDetailed->space_conditions); ?>"
                                    </h5>
                                </div>
                            <?php } elseif (@$info['name'] == 'floor') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        <?php echo $realtyDetailed->floor.' '.Yii::t("RealtyModule.realty", 'этаж'); ?>
                                    </h5>
                                </div>
                            <?php } elseif (@$info['name'] == 'rooms') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        <?php echo Yii::t("RealtyModule.realty",
                                            '{n} комната|{n} комнаты|{n} комнат',
                                            array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                                        ); ?>
                                    </h5>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="w100 center pt-3em flex-0_5em-sm p-1em pb-0 size-1em up">
                <div class="pb-1em-xs pb-1em-sm">
                    <a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="button-article button-grey button-large">
                        <em class="fa fa-reply mr-0_5em" aria-hidden="true"></em>
                        <?php echo Yii::t("OfferModule.offer", "назад"); ?>
                    </a>
                </div>
                <div class="pb-1em-xs pb-1em-sm">
                    <a href="#" class="button-article <?php echo $realtyOffer->getFavClass(); ?> button-large add-to-favorite" data-product-id="<?php echo $realtyOffer->id; ?>">
                        <em class="fa fa-star mr-0_5em" aria-hidden="true"></em>
                        <?php echo Yii::t("OfferModule.offer", "нравится"); ?>
                    </a>
                </div>
                <div class="pb-1em-xs pb-1em-sm">
                    <a href="<?php echo $this->createUrl('/main/default/contact'); ?>" class="button-article button-green button-large phone-parent">
                        <em class="fa fa-mobile phone-more" aria-hidden="true"></em>
                        <?php echo Yii::t("OfferModule.offer", "подробности"); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bottom-menu display-block-xs display-none-sm p-1em">
    <div class="col-xs-12 text-center call-block">
        <div class="flex-0_5em space-between items-center size-0_9em-xs sticky-menu pl-2em pr-2em">
            <div>
                <a href="#" data-activates="slide-out" class="button-collapse"><em class="fa fa-bars" aria-hidden="true"></em></a>
            </div>
            <div>
                <a href="tel:+1800229933">
                    <em class="c-green fa fa-mobile size-3em lh-0_8em" aria-hidden="true"></em>
                </a>
            </div>
            <div>
                <a href="#">
                    <em class="c-green fa fa-reply size-2em" aria-hidden="true"></em>
                </a>
            </div>
        </div>
    </div>
</div>