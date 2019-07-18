<?php
/**
 * @var $model RealtyOffer
 */
?>

<section>
    <div class="owl-carousel owl-theme" id="home-slider">
        <?php foreach ($realtyOffers as $realtyOffer) { ?>
            <div class="item height-32em" style="background: url('/<?php echo ($realtyOffer->realty->contypeMainImage)?$realtyOffer->realty->contypeMainImage->path:''; ?>') no-repeat center bottom / cover">
                <div class="pt-1em pb-1em bc-black-opacity pos-abs bottom-0 w100">
                    <div class="container">
                        <div class="flex items-center center-xs space-between-sm up">
                            <div class="text-center-xs">
                                <div class="hover-red c-white size-1_4em-xs size-1_9em-sm">
                                    <?php echo $realtyOffer->title; ?>
                                </div>
                                <div class="hover-red c-white size-1_2em-sm size-1_5em-sm">
                                    <?php echo $realtyOffer->getShortAddress(); ?>
                                </div>
                            </div>
                            <div class="text-center-xs text-right-sm">
                                <div class="hover-red c-white size-1_4em-xs size-1_9em-sm">
                                    <?php echo $realtyOffer->getType($realtyOffer->type); ?>,
                                    <?php echo ($realtyOffer->realty->realtyDetailed)?$realtyOffer->realty->realtyDetailed->total_space_size:''; ?>
                                    <?php echo ($realtyOffer->realty->realtyDetailed)?$realtyOffer->realty->realtyDetailed->getSpaseSizeUnitView($realtyOffer->realty->realtyDetailed->space_size_units):''; ?>
                                </div>
                                <div class="hover-red c-white size-1_2em-sm size-1_5em-sm">
                                    <?php echo $realtyOffer->getPrice(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-around flex-0-xs display-none-sm w100">
                            <div class="text-center p-0_5em pb-0-xs hover-red size-1_4em">
                                <a class="c-white fancybox" href="/<?php echo $realtyOffer->getUnitedMainImages(); ?>"><em class="fa fa-plus size-0_8em pr-0_3em lh-1_5em" aria-hidden="true"></em><?php echo Yii::t("MainModule.main", "Фото"); ?></a>
                            </div>
                            <div class="text-center p-0_5em pb-0-xs hover-red size-1_4em">
                                <a class="c-white" href="<?php echo Yii::app()->createUrl('/offer/front/single', array('id' => $realtyOffer->id)); ?>">
                                    <em class="fa fa-plus size-0_8em pr-0_3em lh-1_5em" aria-hidden="true"></em>
                                    <?php echo Yii::t("MainModule.main", "Детали"); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-links">
                    <div class="link-left">
                        <a class="inner fancybox" href="/<?php echo $realtyOffer->getUnitedMainImages(); ?>">
                            <em class="fa fa-camera" aria-hidden="true"></em>
                        </a>
                    </div>
                    <div class="link-right">
                        <a class="inner" href="<?php echo Yii::app()->createUrl('/offer/front/single', array('id' => $realtyOffer->id)); ?>">
                            <em class="fa fa-link" aria-hidden="true"></em>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>