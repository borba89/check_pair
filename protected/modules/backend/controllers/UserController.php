<?php
Yii::import('backend.components.BackendController');
Yii::import('backend.components.CAuthHelper');
Yii::import('ext.booster.components.TbEditableSaver');

class UserController extends BackendController
{
    public $import;

    public function init()
    {
        parent::init();
        if(!Yii::app()->user->checkAccess(User::ADMIN)){
            $this->redirect('/backend/default');
        }
    }

    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);

		$this->render('view', array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new User();
		$phones = new PhonesBroker();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

		if(isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()){
                $this->redirect(array('admin'));
            }
        }

		$this->render('create', array(
			'model'=>$model,
            'phones'=>$phones
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

		if($model->role == User::BROCKER){
            $phones = new PhonesBroker();
        }else{
            $phones = new PhonesBroker();
        }


        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];

			if($model->save()){
                $this->redirect(array('admin'));
            }
		}

		$this->render('update', array(
			'model'=>$model,
            'phones'=>$phones
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $this->sidebar_tab = 'users';
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUpdatePassword($id){

        $model = User::model()->findByPk($id);
        $model->scenario = 'updatepassword';
        $model->password = '';

        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {

                // Generating Password
                $salt = $model->generateSalt();
                $password = $model->hashPassword($model->password, $salt);

                if($model->save()){
                    $model->password = $password;
                    $model->salt = $salt;
                    $model->update();
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render("update_password",array("model"=>$model));
    }

    public function actionUpdateItemGroup()
    {
        $es = new TbEditableSaver('LandingContentOrder');
        if ($es->update())
            Yii::app()->ajax->success();
    }

    public function actionUpdateAttribute()
    {
        $es = new TbEditableSaver('User');
        if ($es->update())
            Yii::app()->ajax->success();
    }

    public function actionExportCsv() {
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST["User"])) {
                $model = new User('eventinvitation');
                $model->attributes = $_POST["User"];
                $selecter_users = explode(',', $model->selected_users2);

                if ($selecter_users) {
                    $crt = new CDbCriteria;
                    $crt->condition = 'email <> ""';
                    $crt->addInCondition('id', $selecter_users);

                    $csvUser = User::model()->findAll($crt);
                    CsvExport::export(
                        $csvUser,
                        array('name' => array(), 'surname'=> array(), 'email' => array()),
                        true, // boolPrintRows
                        'users-mail-list--' . date('d-m-Y H-i') . ".csv"
                    );
                }
            }
        } else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionSuggest()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = User::model()->suggestTag($_GET['term']);
            $result = array();
            if ($models) {
                foreach ($models as $m) {
                    $result[$m->fullName.' ('.$m->getAllRoles($m->role).')'] = null;
                }
            }

            echo Yii::app()->ajax->raw($result);
        }
    }

    public function actionLotToggle()
    {
        if (Yii::app()->request->isPostRequest) {
            $id = Yii::app()->request->getQuery('id');
            $user = User::model()->findByPk($id);
            if ($user) {
                $user->is_active = ($user->is_active == 1)
                    ? 0 : 1;
                if ($user->saveAttributes(array('is_active'))) {
                    Yii::app()->ajax->success();
                }
            }

            Yii::app()->ajax->failure();
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }
}
