<?php
/**
 * @var boolean $favorite
 */
?>

<div class="bottom-menu display-block-xs display-none-sm p-1em">
    <div class="col-xs-12 text-center call-block">
        <div class="flex-0_5em space-between items-center size-0_9em-xs sticky-menu pl-1em pr-1em">
            <div>
                <a href="#" data-activates="slide-out" class="button-collapse">
                    <em class="fa fa-bars" aria-hidden="true"></em>
                </a>
            </div>
            <?php if ($favorite) { ?>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/offer/front/favorite'); ?>">
                    <em class="c-green fa fa-star size-2em" aria-hidden="true"></em>
                </a>
            </div>
            <?php } ?>

            <?php if ($filter) { ?>
            <div>
                <a href="#" class="toggle-mobile">
                    <em class="fa fa-sliders size-2em" aria-hidden="true"></em>
                </a>
            </div>
            <?php } ?>

            <div>
                <a href="<?php echo Yii::app()->request->getUrlReferrer(); ?>">
                    <em class="c-green fa fa-reply size-2em" aria-hidden="true"></em>
                </a>
            </div>

            <?php if ($phone) { ?>
            <div>
                <a href="tel:+1800229933">
                    <em class="c-green fa fa-mobile size-3em lh-0_8em" aria-hidden="true"></em>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>