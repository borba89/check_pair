<?php
Yii::import('realty.models.RealtyTags');
Yii::import('realty.models.RealtyTagsConnection');
Yii::import('realty.models.Realty');

class RealtyTagsController extends BackendController
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
        $model=new RealtyTags();

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if(isset($_POST['RealtyTags']))
        {
            $model->attributes = $_POST['RealtyTags'];

            if($model->save()){

                if (isset($_POST['RealtyTags']['realtyTypes'])) {
                    $realtyTypes = $_POST['RealtyTags']['realtyTypes'];
                    foreach ($realtyTypes as $key => $value) {
                        // если галочка установлена
                        if ($value) {
                            $newRealtyType = new RealtyTypeTagsConnection();
                            $newRealtyType->tag_id = $model->id;
                            $newRealtyType->realty_type = $key;
                            $newRealtyType->save();
                        }
                    }
                }

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

        if(isset($_POST['RealtyTags']))
        {
            $model->attributes=$_POST['RealtyTags'];

            if (isset($_POST['RealtyTags']['realtyTypes'])) {
                $realtyTypes = $_POST['RealtyTags']['realtyTypes'];
                $realtyTypesConnect_id = array_keys($model->getRealtyTypesChecked());
                foreach ($realtyTypes as $key => $value) {
                    // если галочка установлена
                    if ($value) {
                        if (!in_array($key, $realtyTypesConnect_id)) {
                            $newRealtyType = new RealtyTypeTagsConnection();
                            $newRealtyType->tag_id = $model->id;
                            $newRealtyType->realty_type = $key;
                            $newRealtyType->save();
                        }
                    } // если галочка убрана
                    elseif (in_array($key, $realtyTypesConnect_id)) {
                        $deleteRealtyType = RealtyTypeTagsConnection::model()->findByPk(['tag_id' => $model->id, 'realty_type' => $key]);
                        $deleteRealtyType->delete();
                    }
                }
                //Если есть тип который уже не существует в realty
                $allTypes = array_keys(Realty::model()->getRealtyType());
                if ($allTypes){
                $impolode = implode('\',\'', $allTypes);
                RealtyTypeTagsConnection::model()->deleteAll("realty_type NOT IN ('{$impolode}')");
                }

                //Если есть чекбокс который уже не имеется в наборе для realty type во всех Realty
                foreach ($allTypes as $realty_type) {
                //Находим все tag_id которые в наборе для realty type
                    $criteria = new CDbCriteria();
                    $criteria->with = 'realtyTypes';
                    $criteria->compare('realtyTypes.realty_type',$realty_type);
                    $allTagsForRealtyType = RealtyTags::model()->findAll($criteria);

                    $res_temp = [];
                    foreach ($allTagsForRealtyType as $val){
                        $res_temp[$val->id] = $val->id;
                    }
                    $allTagsForRealtyType = $res_temp;

                //Находим все tag_id и realty_id realty->type которых соответсвуют realty type,
//                    а tag_id не входят в массив tag_id соответсвующих для realty type
                    $criteria = new CDbCriteria();
                    $criteria->with = 'realty';
                    $criteria->addNotInCondition('tag_id', $allTagsForRealtyType);
                    $criteria->compare('realty.type',$realty_type);
                    $realtyTagsConnectionToDelete = RealtyTagsConnection::model()->findAll($criteria);
                    foreach ($realtyTagsConnectionToDelete as $realtyTagsConnection){
                        $realtyTagsConnection->delete();
                    }
                }
            }

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
        $dataProvider=new CActiveDataProvider('RealtyTags');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new RealtyTags('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['RealtyTags']))
            $model->attributes=$_GET['RealtyTags'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return RealtyTags the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=RealtyTags::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param RealtyTags $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='realty-tags-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
