<?php
Yii::import('backend.components.WebModule');

class OfferModule extends WebModule
{
    public $_localAssetsUrl;

    public function init()
    {
        parent::init();
        $this->setImport(array(
            'offer.models.*',
            'realty.models.*',
            'offer.components.*',
            'offer.widgets.*',
        ));
    }

    public static function menuItem()
    {
        return array(
            'icon' => 'business',
            'label' => Yii::t('OfferModule.offer', 'Объявления'),
            'url' => Yii::app()->createUrl("offer/realtyOffer/admin"),
            'sidebar_tab' => 'offer',
            'position' => 1,
        );
    }

    public static function urlRules()
    {
        return array(
            'offer/front/<param:(rent|sale)>' => 'offer/front',
        );
    }
}