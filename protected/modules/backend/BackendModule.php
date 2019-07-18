<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */
Yii::import('backend.components.WebModule');

class BackendModule extends WebModule
{
    public $assetsDirectory;

    public function init()
    {
        parent::init();
        Yii::app()->language = 'ru';
        $this->setImport(array(
            'backend.models.*',
            'backend.components.*',
            'backend.widgets.*',
            'backend.controllers.*',
            'backend.actions.*',
            'backend.components.crud.*',
        ));

        $this->setComponents(
            array(
                'user' => array(
                    'class' => 'WebUser',
                    'loginUrl' => Yii::app()->createUrl('backend/default/login'),
                    'returnUrl' => array('backend'),
                ),

                'booster' => array(
                    'class' => 'ext.booster.components.Booster',
                    'forceCopyAssets' => false,
                    'fontAwesomeCss' => true,
                    'enableJS' => false,
                    'coreCss' => false,
                ),
            )
        );

        $this->getComponent('booster');
        Yii::app()->errorHandler->errorAction = '/backend/default/error';

        if (!Yii::app()->request->isAjaxRequest) {
            $packages = require_once(Yii::getPathOfAlias("backend").'/config/packages.php');

            if (is_array($packages)) {
                foreach ($packages as $name => $definition) {
                    $this->cs->addPackage($name, $definition);
                }
            }

            $this->cs->scriptMap = array(
                'jquery.js' => $this->assetsUrl.'/plugins/jquery/jquery-2.2.0.min.js',
            );
        }

        $this->assetsDirectory = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/libs');
    }

    public static function menuItem()
    {
        return array(
            'icon' => 'perm_identity',
            'label' => Yii::t('BackendModule.backend', 'Сотрудники'),
            'url' => Yii::app()->createUrl("backend/user/admin"),
            'sidebar_tab' => 'users',
            'position' => 3,
        );
    }

    public static function urlRules()
    {
        return array(
            'backend'=>'backend/default/index',
        );
    }

    public static function statisticBlock()
    {
        return array(
            array(
                'title' => 'User list',
                'value' => User::model()->count('role = "admin"'),
                'descpiption' => 'Users count',
            ),
        );
    }

    public static function getBackendLayoutAlias($layoutName = '')
    {
        return 'backend.views.layouts.'.($layoutName ? $layoutName : 'main');
    }
}
