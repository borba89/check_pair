<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DCrudAction extends CAction
{
    /*
     * @var string $flash key for Yii::app()->user->setFlash($flashSuccess, $message);
     */
    public $flashSuccess = 'success';
    /*
     * @var string $flash key for Yii::app()->user->setFlash($flashError, $message);
     */
    public $flashError = 'error';

    protected function checkIsPostRequest()
    {
        if (!Yii::app()->request->isPostRequest)
            throw new CHttpException (400, Yii::t('yii', 'Your request is invalid.'));
    }

    protected function checkIsAjaxRequest()
    {
        if (!Yii::app()->request->isAjaxRequest)
            throw new CHttpException (400, Yii::t('yii', 'Your request is invalid.'));
    }

    protected function clientCallback($method, $model)
    {
        if (method_exists($this->controller, $method))
            $this->controller->$method($model);
    }

    protected function success($message)
    {
        if (!Yii::app()->request->isAjaxRequest)
            Yii::app()->user->setFlash($this->flashSuccess, Yii::t('BackendModule.main', $message));
    }

    protected function error($message)
    {
        if (!Yii::app()->request->isAjaxRequest)
            Yii::app()->user->setFlash($this->flashError, Yii::t('BackendModule.main', $message));
        else
            throw new CHttpException(400, $message);
    }

    protected function redirectToView($model, $view)
    {
        if (!Yii::app()->request->isAjaxRequest)
            $this->controller->redirect(array($view, 'id' => $model->getPrimaryKey()));
    }

    protected function redirectToManagePage()
    {
        if (!Yii::app()->request->isAjaxRequest)
            $this->controller->redirect(array('admin'));
    }

    protected function redirectToReferrer()
    {
        if (!Yii::app()->request->isAjaxRequest)
            $this->controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * @return CModel
     */
    protected function createModel()
    {
        $this->checkMethodExists('createModel');
        return $this->controller->createModel();
    }

    /**
     * @return CActiveRecord
     */
    protected function loadModel($param = 'id')
    {
        $this->checkMethodExists('loadModel');
        $id = Yii::app()->request->getParam($param);
        $model = $this->controller->loadModel($id);
        return $model;
    }

    /**
     * @return CActiveRecord
     */
    protected function getIndexProviderModel()
    {
        $this->checkMethodExists('getIndexProviderModel');
        $model = $this->controller->getIndexProviderModel();
        return $model;
    }

    protected function checkMethodExists($method)
    {
        if (!method_exists($this->controller, $method))
            throw new CException("Method CController::{$method}() not found");
    }
}
