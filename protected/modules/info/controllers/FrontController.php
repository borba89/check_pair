<?php
Yii::import('main.components.Frontend');

class FrontController extends Frontend
{
    public $apiClass;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'single'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    protected function beforeAction($action)
    {
        $this->apiClass = Yii::createComponent('info.models.ApiInfo');
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->footer_phone = true;
        $infoblocks = $this->apiClass->getInfoBlogs();
        $this->render('info', array('infoblocks' => $infoblocks));
    }
}