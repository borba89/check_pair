<?php
class MenuController extends BackendController
{

    public function actionCreate()
    {
        $model = new MMenu;
        if (isset($_POST['MMenu'])) {
            $model->setAttributes($_POST['MMenu']);


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('/backend/menu'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        } elseif (isset($_GET['MMenu'])) {
            $model->attributes = $_GET['MMenu'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['MMenu'])) {
            $model->setAttributes($_POST['MMenu']);
            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('/backend/menu'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('/backend/menu'));
            }
    }

    public function actionIndex()
    {
        $model = new MMenu('search');
        $model->unsetAttributes();

        if (isset($_GET['MMenu']))
            $model->setAttributes($_GET['MMenu']);

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function createModel()
    {
        return new MMenu();
    }

    public function loadModel($id)
    {
        $model = MMenu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

    public function actionToggle($id, $attribute, $model)
    {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/backend/menu'));
    }

    /*public function beforeAction($action)
    {
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }*/

}

//End of Controller Class
