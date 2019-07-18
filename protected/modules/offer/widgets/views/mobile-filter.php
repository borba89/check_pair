<?php
    $activeFilter = $this->controller->apiClass->getActiveFilter();
?>
<div class="mobile-filter-block pb-5_5em">
    <div class="w100 bc-green text-center cur-def p-1em">
        <div class="up c-white size-1_3em lh-1_3em"><?php echo Yii::t("OfferModule.offer", "Что именно вы ищете?");?></div>
    </div>
    <?php $form=$this->beginWidget('CActiveForm',array(
        'id' => 'mobile-realty-filter',
    )); ?>
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header active"><?php echo Yii::t("OfferModule.offer", "Предложение"); ?></div>
                <div class="collapsible-body">
                    <ul class="uncheckAll">
                        <?php $this->widget('DButtonGroup', array(
                            'buttons' => $filters['realtyOffer'],
                            'name' => 'realtyOffer',
                            'idSufix' => 'mobile',
                            'activeFilter' => $activeFilter,
                        )); ?>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><?php echo Yii::t("OfferModule.offer", "РАЙОНЫ КИШИНЁВА"); ?></div>
                <div class="collapsible-body">
                    <ul class="sector-list uncheckAll">
                        <?php $this->widget('DButtonGroup', array(
                            'buttons' => $filters['districts'],
                            'name' => 'districts',
                            'idSufix' => 'mobile',
                            'activeFilter' => $activeFilter,
                        )); ?>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><?php echo Yii::t("OfferModule.offer", "Тип недвижимости"); ?></div>
                <div class="collapsible-body">
                    <ul class="uncheckAll">
                        <?php $this->widget('DButtonGroup', array(
                            'buttons' => $filters['realtyType'],
                            'name' => 'realtyType',
                            'idSufix' => 'mobile',
                            'activeFilter' => $activeFilter,
                        )); ?>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><?php echo Yii::t("OfferModule.offer", "Площадь"); ?></div>
                <div class="collapsible-body">
                    <ul class="uncheckAll">
                        <?php $this->widget('DButtonGroup', array(
                            'buttons' => $filters['areaFilter'],
                            'name' => 'areaFilter',
                            'idSufix' => 'mobile',
                            'activeFilter' => $activeFilter,
                        )); ?>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><?php echo Yii::t("OfferModule.offer", "Цена"); ?></div>
                <div class="collapsible-body">
                    <ul class="uncheckAll">
                        <?php $this->widget('DButtonGroup', array(
                            'buttons' => $filters['moneyFilter'],
                            'name' => 'moneyFilter',
                            'idSufix' => 'mobile',
                            'activeFilter' => $activeFilter,
                        )); ?>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="w100 flex space-between p-0_5em">
            <a
                class="reload pt-0_2em btn waves-effect waves-light up reset"
                href="<?php echo Yii::app()->createUrl('/offer/front/reset'); ?>">
                <?php echo Yii::t("OfferModule.offer", "сбросить"); ?>
            </a>
            <a class="execute pt-0_2em btn waves-effect waves-light up submit" type="submit" name="action">
                <?php echo Yii::t("OfferModule.offer", "Применить фильтры"); ?>
            </a>
        </div>
    <?php $this->endWidget(); ?>
</div>