<?php
class MobileFilter extends CWidget
{
    public function init() {
        $apiOffer = Yii::createComponent('offer.models.ApiOffer');
        $this->render('mobile-filter', array('filters' => $apiOffer->getFilters()));
    }
}