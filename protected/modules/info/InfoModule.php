<?php
Yii::import('backend.components.WebModule');
Yii::import('blog.models.BlogArticle');

class InfoModule extends WebModule
{
    public $_localAssetsUrl;

    public function init()
    {
        parent::init();
        $this->setImport(array(
            'info.models.*',
            'info.components.*',
            'info.widgets.*',
            'offer.models.*',
        ));
    }

    public static function menuItem()
    {
        return array(
            'icon' => 'info',
            'label' => Yii::t('InfoModule.info', 'Услуги агенства'),
            'url' => Yii::app()->createUrl("info/infoBlock/admin"),
            'sidebar_tab' => 'info',
            'position' => 5,
        );
    }

    public static function urlRules()
    {
        return array(
        );
    }
}