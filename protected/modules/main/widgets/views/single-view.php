<?php
/**
 * @var $model RealtyOffer
 */
?>

<section class="single-carousel-parent mb-2em-xs">
    <div class="owl-carousel owl-theme" id="home-slider">
        <?php if ($images = $model->getUnitedImages()) { ?>
        <?php foreach ($images as $image) { ?>
            <div class="item height-32em" style="background: url('/<?php echo $image->path; ?>') no-repeat center bottom / cover">
                <div class="pt-1em pb-1em bc-black-opacity pos-abs bottom-0 w100 display-none-xs">
                    <div class="container">
                        <div class="flex items-center center-xs space-between-sm up">
                            <div class="text-center-xs">
                                <div class="hover-red c-white size-1_4em-xs size-1_9em-sm">
                                    <?php echo $model->title; ?>
                                </div>
                                <div class="hover-red c-white size-1_2em-sm size-1_5em-sm">
                                    <?php echo $model->getAddress(); ?>
                                </div>
                            </div>
                            <div class="text-center-xs text-right-sm">
                                <div class="hover-red c-white size-1_4em-xs size-1_9em-sm">
                                    <?php echo $model->getType($model->type); ?>,
                                    <?php echo ($model->realty->realtyDetailed)?$model->realty->realtyDetailed->total_space_size:''; ?>
                                    <?php echo ($model->realty->realtyDetailed)?$model->realty->realtyDetailed->getSpaseSizeUnitView($model->realty->realtyDetailed->space_size_units):''; ?>
                                </div>
                                <div class="hover-red c-white size-1_2em-sm size-1_5em-sm">
                                    <?php echo $model->getPrice(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-around flex-0-xs display-none-sm w100">
                            <div class="text-center p-0_5em pb-0-xs hover-red size-1_4em">
                                <a class="c-white fancybox" href="/<?php echo $image->path; ?>"><em class="fa fa-plus size-0_8em pr-0_3em lh-1_5em" aria-hidden="true"></em><?php echo Yii::t("MainModule.main", "Фото"); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-links">
                    <div class="link-left">
                        <a class="inner fancybox" href="/<?php echo $image->path; ?>">
                            <em class="fa fa-camera" aria-hidden="true"></em>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php } ?>
    </div>
</section>