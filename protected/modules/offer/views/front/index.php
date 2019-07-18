<div class="main">
    <?php $this->widget('offer.widgets.OfferFilter'); ?>
    <div id="content-outer" class="size-0_7em-sm size-0_9em-md size-1em-lg">
        <div class="pt-3em">
            <?php $this->widget('ListView', array(
                'id'=>'realty-list',
                'sidePager' => true,
                'updateSelector' => '#realty-list .flex.items-center.space-between.pt-1em.pb-2em-sm a, #realty-list .col-xs-12.col-sm-12.col-md-6.mt-2em-sm a, #realty-list .side-links a',
                'dataProvider' => $realtyOffers,
                'pagerCssClass' => 'flex items-center space-between pt-1em pb-2em-sm',
                'htmlOptions' => array('class' => 'container'),
                'itemsCssClass' => 'flex-2em child-mb-3em',
                'itemView' => '_offer_grid', // refers to the partial view named '_post'
                'pager' => "LinkPager",
                'template' => "{items}\n{pager}",
                'cssFile' => false,
                'summaryText' => false,
                'sorterCssClass' => 'col-xs-12 col-sm-12 col-md-6 mt-2em-sm',
                'sortableAttributes' => array(
                    'ammount',
                    'realty.space_sq_meters'
                ),
            )); ?>
        </div>
    </div>
</div>
<?php $this->widget('offer.widgets.MobileFilter'); ?>
