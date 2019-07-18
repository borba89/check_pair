<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

Yii::import('main.components.MainUrlRouter');
Yii::import('offer.components.OfferRouter');
Yii::import('info.components.InfoRouter');

class Frontend extends Controller
{
    public $google_analitics;
    public $_assetsUrl;
    public $_curNav;
    public $landing_id;

    public $footer_filter = false;
    public $footer_favorite = false;
    public $footer_phone = false;

    public function urltrans($url)
    {
        if ($lurl = MainUrlRouter::Instance()->urltrans($url)) {
            return $lurl;
        }
        if ($lurl = OfferRouter::Instance()->urltrans($url)) {
            return $lurl;
        }
        if ($lurl = InfoRouter::Instance()->urltrans($url)) {
            return $lurl;
        }

        return $url;
    }

    public function init()
    {
        $this->layout = Yii::app()->getModule('main')->getLayoutAlias();

        if (!Yii::app()->request->isAjaxRequest) {
            Yii::app()->getClientScript()->registerPackage('base');
        }

        return parent::init();
    }

    public function behaviors()
    {
        return array(
            'seo' => array('class' => 'application.vendor.chemezov.yii-seo.behaviors.SeoBehavior'),
        );
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function setTitle($value)
    {
        $this->setPageTitle(Yii::app()->name.' - '.$value);
    }
}