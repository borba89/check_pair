<?php
/**
 * @var RealtyOffer $data
 */
?>
<!--
<div class="col-xs-12 col-sm-4">
    <div class="mb-1em">
        <div class="scale-img-parent">
            <img class="w100 scale-out-img"
                 src="<?php echo ($data->realty->contypeMainImage)?YHelper::getImagePath($data->realty->contypeMainImage->path, 359, 255):''; ?>" alt="">
            <div class="image-links">
                <div class="block-center">
                    <a class="link-inner fancybox" href="/<?php echo ($data->realty->contypeMainImage)?$data->realty->contypeMainImage->path:''; ?>">
                        <em class="fa fa-camera" aria-hidden="true"></em>
                    </a>
                </div>
            </div>
            <div class="promo">
                <div class="up">
                    <?php echo $data->getPrice(); ?>
                </div>
            </div>
        </div>
    </div>
    <div>
        <blockquote>
            <div class="mb-0_8em">
                <h2 class="size-1_4em m-0 up"><?php echo $data->title; ?></h2>
                <span class="size-1_1em f-light">
                    <?php echo $data->realty->addressTable->street; ?>
                </span>
            </div>
            <div>
                <span class="size-1_1em up">
                    <?php echo $data->getType($data->type); ?>,
                    <?php echo ($data->realty->realtyDetailed)?$data->realty->realtyDetailed->total_space_size:''; ?>
                    <?php echo ($data->realty->realtyDetailed)?$data->realty->realtyDetailed->getSpaseSizeUnitView($data->realty->realtyDetailed->space_size_units):''; ?>
                </span>
            </div>
        </blockquote>
    </div>
    <div class="flex-0_5em child-mb-0_5em-xs">
        <div class="col-xs-6 col-sm-6">
            <a href="<?php echo Yii::app()->createUrl('/offer/front/single', array('id' => $data->id)); ?>" class="button-medium button-green w100">
                <i class="fa fa-list-ul" aria-hidden="true"></i>
                <?php echo Yii::t("OfferModule.offer", "Детали"); ?>
            </a>
        </div>
        <div class="col-xs-6 col-sm-6">
            <a href="#" class="button-medium <?php echo $data->getFavClass(); ?> w100 add-to-favorite" data-product-id="<?php echo $data->id; ?>">
                <i class="fa fa-star" aria-hidden="true"></i>
                <?php echo Yii::t("OfferModule.offer", "Нравится"); ?>
            </a>
        </div>
    </div>
</div>