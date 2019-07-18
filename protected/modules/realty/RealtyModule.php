<?php
Yii::import('backend.components.WebModule');

class RealtyModule extends WebModule
{
    public $_localAssetsUrl;

    public function init()
    {
        parent::init();
        $this->setImport(array(
            'realty.models.*',
            'realty.components.*',
            'realty.widgets.*',
        ));
    }

    public static function menuItem()
    {
        return array(
            'icon' => 'vpn_key',
            'label' => Yii::t('BackendModule.backend', 'Реестр недвижимости'),
            'url' => Yii::app()->createUrl("realty/realty/admin"),
            'sidebar_tab' => 'realty',
            'position' => 2,
        );
    }

    public static function urlRules()
    {
        return array(
        );
    }
}