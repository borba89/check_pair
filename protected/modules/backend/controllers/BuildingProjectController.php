<?php
Yii::import('realty.models.BuildingProject');

class BuildingProjectController extends BackendController
{
    public $defaultAction = 'admin';

    public function actions()
    {
        $ret = array(
            'admin'=>'DAdminAction',
            'view' => 'DViewAction',
            'create'=> array(
                'class' => 'DCreateAction',
                'redirect' => 'admin',
            ),
            'delete' => 'DDeleteAction',
            'update'=> array(
                'class' => 'DUpdateAction',
                'redirect' => 'admin',
            ),
        );

        return $ret;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new BuildingProject();

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if(isset($_POST['BuildingProject']))
        {
            $model->attributes = $_POST['BuildingProject'];

            if($model->save()){
                $this->redirect(['admin']);
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if(isset($_POST['BuildingProject']))
        {
            $model->attributes=$_POST['BuildingProject'];

            if($model->save())
                $this->redirect(['admin']);
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('BuildingProject');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new BuildingProject('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['BuildingProject']))
            $model->attributes=$_GET['BuildingProject'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return BuildingProject the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=BuildingProject::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BuildingProject $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='realty-building-project-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
