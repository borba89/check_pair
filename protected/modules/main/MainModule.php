<?php
Yii::import('backend.components.WebModule');

class MainModule extends CWebModule
{
    public $_assetsUrl;
    protected $cs;

	public function init()
	{
        parent::init();

        /**
         * Установка пути к файлам представления из текущей темы
         */
        if($theme = $this->getTeheme()){
            $viewPath = Yii::getPathOfAlias("webroot.themes.{$theme}.views.main");
            $this->setViewPath($viewPath);
        }

        $this->setImport(array(
            'main.models.*',
            'main.components.*',
            'main.widgets.*',
            'main.controllers.*',
            'main.actions.*',
            'main.components.crud.*',
            'realty.models.*',
            'offer.models.*',
		));

        Yii::app()->setComponents(array(
            'ajax' => array(
                'class' => 'application.modules.backend.components.AsyncResponse',
            ),
            'user' => array(
                'loginUrl' => '/',
            ),
        ));

        Yii::app()->errorHandler->errorAction = '/main/default/error';

        if (!Yii::app()->request->isAjaxRequest) {
            $this->cs = Yii::app()->getClientScript();
            if (YII_DEBUG) $this->getAssetsUrl();

            /**
             * Темизация модуля, если включена тема, использовать пакеты из темы
             */
            $theme = $this->getTeheme();
            if($theme){
                $packages = require_once(Yii::getPathOfAlias("main")."/config/{$theme}/packages.php");
            }else{
                $packages = require_once(Yii::getPathOfAlias("main").'/config/packages.php');
            }


            if(is_array($packages)) {
                foreach ($packages as $name => $definition) {
                    $this->cs->addPackage($name, $definition);
                }
            }

            Yii::app()->clientScript->coreScriptPosition=CClientScript::POS_HEAD;
            $this->cs->scriptMap['jquery.js'] = $this->assetsUrl.'/js/plugins/jquery.min.js';
        }
	}

    public function beforeControllerAction($controller, $action)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->cs->registerPackage('base');
        }

        return true;
    }

    public static function urlRules()
    {
        return array(
            array('class' => 'offer.components.OfferRouter'),
            array('class' => 'info.components.InfoRouter'),
            array('class' => 'main.components.MainUrlRouter'),
            'contact' => 'main/default/feedback',
            'schedule' => 'main/user/schedule',
        );
    }

    /**
     * Определение макета в зависимости от темы
     * @param string $layoutName
     * @return string
     */
    public function getLayoutAlias($layoutName = '')
    {
        $theme = $this->getTeheme();

        if($theme){
            return "webroot.themes.{$theme}.views.main.layouts.".($layoutName ? $layoutName : 'main');
        }else{
            return 'main.views.layouts.'.($layoutName ? $layoutName : 'main');
        }
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('main.assets'), false,-1, YII_DEBUG);

        return $this->_assetsUrl;
    }

    /**
     * В зависимости от текущей темы определить assets
     * @return mixed
     */
    public function getThemeAssets()
    {
        $theme = $this->getTeheme();
        if ($theme){
            return Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias("webroot.themes.{$theme}.assets"), false,-1, YII_DEBUG);
        }else{
            return Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('main.assets'), false,-1, YII_DEBUG);
        }
    }

    /**
     * Вернуть логотип компании
     * @return string
     */
    public function getCompanyLogo()
    {
        $logo = Yii::app()->settings->get(Settings::COMPANY, 'company_logo');
        return ($logo) ? $logo : $this->assetsUrl . '/img/logo-moldrealty.png';
    }

    public function getFooterLogo()
    {
        $logo = Yii::app()->settings->get(Settings::COMPANY, 'footer_logo');
        return ($logo) ? $logo : $this->assetsUrl . '/img/logo-moldrealty.png';
    }

    /**
     * Возвращает текущую тему, если установлена в настройках или параметрах приложения
     * В случае неудачи вернуть null
     * @return mixed
     * @throws CException
     */
    protected function getTeheme()
    {
        Yii::import('backend.models.Settings');
        $theme = Yii::app()->settings->get(Settings::CUSTOM, 'frontend_theme', null);

        if(!$theme){
            $theme = isset(Yii::app()->params['frontend_theme']) ? Yii::app()->params['frontend_theme'] : null;
        }
        return $theme;
    }
}
