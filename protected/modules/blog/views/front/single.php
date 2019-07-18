<?php
/**
 * @var BlogArticle $blog
 */
?>

<div class="main">
    <div id="p_prldr">
        <div class="contpre">
            <span class="svg_anm"></span>
        </div>
    </div>
    <section class="w100 text-center up c-white pt-4_5em pb-6em mb-3em bx-shadow-1 parallax-window" data-parallax="scroll" data-image-src="/<?php echo $blog->image; ?>">
        <h3 class="f-medium ls-0_03em">
            <?php echo $blog->title; ?>
        </h3>
        <?php if ($blog->author) { ?>
            <h5 class="ls-0_03em"><?php echo $blog->author; ?></h5>
        <?php } ?>
    </section>
    <section>
        <div class="container-1260">
            <div class="article flex mb-3em no-wrap-sm wrap-xs pb-1_5em">
                <?php echo CHtml::encode($blog->content); ?>
                <div class=" w100 text-center pt-3em">
                    <a href="<?php echo Yii::app()->request->getUrlReferrer(); ?>" class="button-article button-green">
                        <?php echo Yii::t("BlogModule.blog", "назад");?>
                    </a>
                </div>
            </div>
        </div>
    </section>
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