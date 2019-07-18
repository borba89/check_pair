<?php
    $activeFilter = $this->controller->apiClass->getActiveFilter();
?>
<div id="p_prldr">
    <div class="contpre">
        <span class="svg_anm"></span>
    </div>
</div>
<div class="pos-rel display-none-xs">
    <div class="filter-bar size-0_7em-sm size-0_9em-md size-1em-lg">
        <div class="container">
            <div class="flex-0_5em space-between items-center pt-1em pb-1em f-light">
                <div class="col-xs-12 col-sm-1">
                    <div>
                        <a href="#" class="toggle"><i class="fa fa-angle-down size-1_5em" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="size-1_1em up hover-red"><?php echo $activeFilter['districts']; ?></div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="size-1_1em up hover-red"><?php echo $activeFilter['realtyOffer']; ?></div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="size-1_1em up hover-red"><?php echo $activeFilter['realtyType']; ?></div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="size-1_1em up hover-red"><?php echo $activeFilter['areaFilter']; ?></div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="size-1_1em up hover-red"><?php echo $activeFilter['moneyFilter']; ?></div>
                </div>
                <div class="favorite-button col-xs-12 col-sm-1">
                    <div class="flex items-center flex-end-sm">
                        <a href="<?php echo Yii::app()->createUrl('/offer/front/favorite'); ?>">
                            <div class="flex items-center wish-sign display-none-xs">
                                <div class="size-1_5em">
                                    <i class="fa fa-star c-orange" aria-hidden="true"></i>
                                </div>
                                <div id="totalFav" class="pl-0_3em">
                                    <?php echo Favorite::model()->getTotalFav(); ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $form=$this->beginWidget('CActiveForm',array(
        'id' => 'realty-filter',
    )); ?>
    <div class="filter-list size-0_7em-sm size-0_9em-md size-1em-lg pt-1em">
        <div class="container">
            <div class="flex-0_5em space-between">
                <div class="col-xs-12 col-sm-1"></div>
                <div class="col-xs-12 col-sm-2">
                    <blockquote>
                        <ul class="sector-list uncheckAll">
                            <?php $this->widget('DButtonGroup', array(
                                'buttons' => $filters['districts'],
                                'name' => 'districts',
                                'activeFilter' => $activeFilter,
                            )); ?>
                        </ul>
                    </blockquote>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <blockquote>
                        <ul class="uncheckAll">
                            <?php $this->widget('DButtonGroup', array(
                                'buttons' => $filters['realtyOffer'],
                                'name' => 'realtyOffer',
                                'activeFilter' => $activeFilter,
                            )); ?>
                        </ul>
                    </blockquote>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <blockquote>
                        <ul id="realtyType" class="uncheckAll">
                            <?php $this->widget('DButtonGroup', array(
                                'buttons' => $filters['realtyType'],
                                'name' => 'realtyType',
                                'activeFilter' => $activeFilter,
                            )); ?>
                        </ul>
                    </blockquote>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <blockquote>
                        <ul id="areaFilter" class="uncheckAll">
                            <?php $this->widget('DButtonGroup', array(
                                'buttons' => $filters['areaFilter'],
                                'name' => 'areaFilter',
                                'activeFilter' => $activeFilter,
                            )); ?>
                        </ul>
                    </blockquote>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <blockquote>
                        <ul id="moneyFilter" class="uncheckAll">
                            <?php $this->widget('DButtonGroup', array(
                                'buttons' => $filters['moneyFilter'],
                                'name' => 'moneyFilter',
                                'activeFilter' => $activeFilter,
                            )); ?>
                        </ul>
                    </blockquote>
                </div>
                <div class="col-xs-12 col-sm-1"></div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
