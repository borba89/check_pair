<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

class DefaultController extends BackendController
{
    public $sidebar_tab = "dashboard";

    public function actionIndex()
    {
        $this->layout = "/layouts/main";
        $this->render("dashboard");
    }

    public function actionError()
    {
        if (Yii::app()->user->getProfileField('role') != User::ADMIN) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->layout = "/layouts/layout_error";
        $this->sidebar_tab = null;

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionError404()
    {
        $this->layout = "/layouts/layout_error";
        $this->render('error');
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = "/layouts/layout_login";
        $model = new BackendLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['BackendLoginForm'])) {
            $model->attributes = $_POST['BackendLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->isStaffAndNotSuspended() && $model->login()) {
                $this->redirect("/backend");
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->getModule('backend')->user->loginUrl);
    }

    public function renderStatistic()
    {
        $allModule = explode('|', MODULES_MATCHES);

        if(!empty($allModule)) {
            $allBlocks = array();
            foreach($allModule as $moduleName) {
                $class = ucfirst($moduleName) . 'Module';
                Yii::import($moduleName . '.' . $class);

                if(method_exists($class, 'statisticBlock')) {
                    foreach(call_user_func($class. '::statisticBlock') as $block)
                        $allBlocks[] = $block;
                }
            }
        }
        $this->renderPartial('statistic_blocks', array('allBlocks' => $allBlocks));
    }
}