<?php

/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */
class ApiModule extends CWebModule {

    private $_assetsUrl;

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        Yii::app()->errorHandler->errorAction = '/api/default/error';
        Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_HEAD;

        $this->setImport(array(
            'api.models.*',
            'api.components.*',
            'api.actions.*',
            'backend.components.ContentType',
            'backend.models.*',
        ));

        Yii::app()->setComponents(array(
            'ajax' => array(
                'class' => 'backend.components.AsyncResponse',
            ),
        ));
    }

    public static function getUrlRules() {
        return array(
          'api/<action:\w+>'=>'api/api/<action>',
          'login' => 'backend/default/login',
          'error' => 'backend/default/error',
          'myProfile' => 'backend/profile/myProfile',
        );
    }
}
