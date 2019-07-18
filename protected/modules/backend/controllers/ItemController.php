<?php

class ItemController extends BackendController
{
    public function actionIndex($id)
    {
        $activeId = isset($_GET['activeId']) ? $_GET['activeId'] : '';
        $items = MMenuItem::model()->findAllByAttributes(array('menu_id' => $id));
        $this->render('index', array(
            'items' => $items,
            'id' => $id,
            'activeId' => $activeId
        ));
    }

    public function actionCreate()
    {
        $model = new MMenuItem;
        $menus = MMenu::model()->findAll();
        //echo CVarDumper::dump($menus,10,true);exit;
        if (isset($_POST['MMenuItem'])) {
            //echo CVarDumper::dump($_POST,10,true);exit;
            $model->setAttributes($_POST['MMenuItem']);
            if (isset($_POST['MMenuItem']['menu'])){
                $model->menu_id = $_POST['MMenuItem']['menu'];
            }

            if (isset($_POST['MMenuItem']['parent'])){
                $model->parent_id = $_POST['MMenuItem']['parent'];
            }


            $model->link_en = $_POST['MMenuItem']['url_en'];
            $model->link_ro = $_POST['MMenuItem']['url_ro'];
            $model->link_ru = $_POST['MMenuItem']['url_ru'];

            if (isset($_POST['MMenuItem']['role']))
                $model->role = implode(',', $_POST['MMenuItem']['role']);
            else
                $model->role = '';

            //pushing newly added item to last
            $maxRight = $model->getMaxRight();
            $model->lft = $maxRight + 1;
            $model->rgt = $maxRight + 2;

            //echo CVarDumper::dump($_POST,10,true);
            //echo CVarDumper::dump($model->attributes,10,true);exit;
            try {
                if ($model->save()) {
                    $this->redirect(array('/' . $this->module->id . '/item/index', 'id' => $model->menu_id, 'activeId' => $model->id));
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        } elseif (isset($_GET['MMenuItem'])) {
            $model->attributes = $_GET['MMenuItem'];
        }

        $this->render('create', array('model' => $model, 'menuId' => $_GET['id'], 'menus'=>$menus));
    }

    public function actionEdit()
    {
        $model = $this->loadModel($_GET['id']);
        $menus = MMenu::model()->findAll();
        if (isset($_POST['MMenuItem'])) {
            //echo CVarDumper::dump($_POST,10,true);exit;
            $model->setAttributes($_POST['MMenuItem']);
            if (!isset($_POST['MMenuItem']['target'])) {
                $model->target = NULL;
            }
            $model->menu = $_POST['MMenuItem']['menu'];

            $model->link_en = $_POST['MMenuItem']['url_en'];
            $model->link_ro = $_POST['MMenuItem']['url_ro'];
            $model->link_ru = $_POST['MMenuItem']['url_ru'];

            $model->parent = $_POST['MMenuItem']['parent'];

            if (isset($_POST['MMenuItem']['role']))
                $model->role = implode(',', $_POST['MMenuItem']['role']);
            else
                $model->role = '';

            try {
                if ($model->save()) {
                    $this->redirect(array('/' . $this->module->id . '/item/index', 'id' => $model->menu_id, 'activeId' => $model->id));
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        }

        $this->render('edit', array(
            'model' => $model,
            'menus'=>$menus,
            'menuId'=>$model->menu_id,
        ));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $menuId = $model->menu_id;

            try {
                $model->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('/' . $this->module->id . '/item?id=' . $menuId));
            }
    }

    public function loadModel($id)
    {
        $model = MMenuItem::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

}