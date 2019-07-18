<?php

$lang = $post['lng'];

$tCriteria = new CDbCriteria();
$tCriteria->condition = 'item_id = :item_offer && content_type = "realtyoffer"';
$tCriteria->addCondition('item_id = :item_realty && content_type = "realtyoffer"', 'OR');
//$tCriteria->params[':item_offer'] = isset($post['realty_id'])?$post['realty_id']:$post['temp_id'];
$tCriteria->params[':item_offer'] = isset($post['realty_id'])?$post['temp_id']:$post['temp_id'];
$tCriteria->params[':item_realty'] = isset($post['realty_id'])?$post['realty_id']:$post['temp_id'];

$images = MultipleImages::model()->findAll($tCriteria);

$additionalInfo = false;
//var_dump($images);
//var_dump($post);
if(isset($post['realty_id'])){
    $videos = RealtyOfferVideo::model()->findAllByAttributes(array(
            'offer_id'=>$post['temp_id']
    ));
}
?>
<div class="main">
    <div id="p_prldr">
        <div class="contpre">
            <span class="svg_anm"></span>
        </div>
    </div>
    <?php $this->widget('main.widgets.PreviewSliderWidgetAd', array(
        'images' => $images,
        'post' => $post,
        'realty' => null,//$realty
    )); ?>
    <div class="container-1260">
        <div class="article flex space-between mb-3em no-wrap-sm wrap-xs pb-1_5em">
            <div class="pl-1_5em-sm col-sm-12 col-md-8 pt-2em-xs">
                <div class="size-1_2em p-1em pt-2em pr-3em-lg">
                    <p><?php echo $post['description_'.$lang]; ?></p>
                </div>
            </div>
            <?php if(isset($post['realty_id']) && $videos):?>
                <?php foreach ($videos as $video):?>
                    <div class="col s12 m6 l6">
                        <div class="size-1_2em p-1em pt-2em pr-3em-lg">
                            <object width="420" height="315"
                                    data="<?php echo $video->url;?>">
                            </object>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
            <?php if(isset($post['url'])):?>
                <?php $url = YoutubeCode::getCode($post['url']);?>
                <div class="col s12 m6 l6">
                    <div class="size-1_2em p-1em pt-2em pr-3em-lg">
                        <object width="420" height="315"
                                data="<?php echo $url;?>">
                        </object>
                    </div>
                </div>
            <?php endif;?>
            <div class="col-xs-12 col-sm-12 col-md-4 p-2em ">
                <div class="flex column bc-green c-white up pl-1em pr-1em text-center dashed-border">
                    <?php if ($additionalInfo) { ?>
                        <?php foreach ($additionalInfo as $info) { ?>
                            <?php if (@$info['name'] == 'newly_built') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        <?php echo $realty->realtyDetailed->newlyBuildLabel(); ?>
                                    </h5>
                                </div>
                            <?php } elseif (@$info['name'] == 'space_conditions') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        "<?php echo $realty->realtyDetailed->getSpaseConditions($realty->realtyDetailed->space_conditions); ?>"
                                    </h5>
                                </div>
                            <?php } elseif (@$info['name'] == 'floor') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        <?php echo $realty->realtyDetailed->floor.' '.Yii::t("RealtyModule.realty", 'этаж'); ?>
                                    </h5>
                                </div>
                            <?php } elseif (@$info['name'] == 'rooms') { ?>
                                <div class="pt-1em pb-1em">
                                    <h5 class="ls-0_03em">
                                        <?php echo Yii::t("RealtyModule.realty",
                                            '{n} комната|{n} комнаты|{n} комнат',
                                            array($realty->realtyDetailed->rooms, '{n}' => $realty->realtyDetailed->rooms)
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
                    <a href="#" class="button-article button-grey button-large">
                        <em class="fa fa-reply mr-0_5em" aria-hidden="true"></em>
                        <?php echo Yii::t("OfferModule.offer", "назад"); ?>
                    </a>
                </div>
                <div class="pb-1em-xs pb-1em-sm">
                    <a href="#" class="button-article button-red button-large add-to-favorite">
                        <em class="fa fa-star mr-0_5em" aria-hidden="true"></em>
                        <?php echo Yii::t("OfferModule.offer", "нравится"); ?>
                    </a>
                </div>
                <div class="pb-1em-xs pb-1em-sm">
                    <a href="#" class="button-article button-green button-large phone-parent">
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