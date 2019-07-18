<?php
/**
 * @var BlogArticle $data
 */
?>

<div class="article flex mb-3em no-wrap-sm wrap-xs pb-2em">
    <div class="col-xs-12 col-sm-4 pr-2_5em-sm">
        <div class="scale-img-parent">
            <img class="scale-out-img" src="<?php echo Yii::app()->iwi->load($data->image)->adaptive(359, 255)->cache(); ?>" alt="news-post">
            <div class="image-links">
                <div class="block-center">
                    <a class="link-inner" href="news-single.html">
                        <em class="fa fa-link" aria-hidden="true"></em>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="pl-1_5em-sm col-sm-8 pt-2em-xs">
        <div class="h100 flex column space-between">
            <div class="h5 up lh-1em"><?php echo $data->title; ?></div>
            <div class="size-1_1em">
                <p>
                    <?php echo YText::wordLimiter($data->content, 80); ?>
                </p>
            </div>
            <div class="">
                <a href="<?php echo Yii::app()->createUrl('/blog/front/single', array('id' => $data->id)); ?>" class="button-article button-green">
                    <?php echo Yii::t("BlogModule.blog", "читать");?>
                </a>
            </div>
        </div>
    </div>
</div>