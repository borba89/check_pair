<?php
class OfferFilter extends CWidget
{
    public function init() {
        $apiOffer = Yii::createComponent('offer.models.ApiOffer');
        $this->render('offer-filter', array('filters' => $apiOffer->getFilters()));
    }
}