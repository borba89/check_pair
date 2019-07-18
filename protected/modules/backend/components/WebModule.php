<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */
Yii::import('backend.components.ContentType');

class WebModule extends CWebModule
{
    protected $_assetsUrl;
    protected $cs;

    public function init() {
        $this->cs = Yii::app()->getClientScript();

        Yii::app()->setComponents(array(
            'ajax' => array(
                'class' => 'application.modules.backend.components.AsyncResponse',
            ),
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if ($controller instanceof BackendController) {
            Yii::app()->language = 'ru';
            if (parent::beforeControllerAction($controller, $action)) {
                if (!Yii::app()->request->isAjaxRequest) {
                    if (YII_DEBUG) $this->getAssetsUrl();

                    if ($action->id == 'login')
                        $this->cs->registerPackage('login');
                    else
                        $this->cs->registerPackage('backendbase');
                }

                // this method is called before any module controller action is performed
                // you may place customized code here
                $route = $controller->id . '/' . $action->id;

                // echo $route;
                $publicPages = array(
                    'default/login',
                    'default/error',
                    'album/upload',
                    'album/gallery',
                    'layout/upload',
                );
                if (Yii::app()->user->isGuest && !in_array($action->id, array('upload', 'gallery')) && !in_array($route, $publicPages) && ($controller instanceof BackendController)) {
                    Yii::app()->getModule('backend')->user->loginRequired();
                } else
                    return true;
            } else
                return false;
        } else
            return true;
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('backend.assets'), false,-1, YII_DEBUG);
        return $this->_assetsUrl;
    }
}
