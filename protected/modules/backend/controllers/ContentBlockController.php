<?php
Yii::import('backend.components.BackendController');
class ContentBlockController extends BackendController
{
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('adminRealty','adminPartners','createRealty', 'createPartners', 'updateRealty', 'updatePartners', 'admin', 'view', 'create','delete','update'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

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

    public function createModel()
    {
        $step = Yii::app()->request->getParam('step', null);
        if ($step) {
            return new ContentBlock($step);
        } else {
            return new ContentBlock();
        }
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
    /*public function actionCreate()
    {
        $model=new ContentBlock;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ContentBlock']))
        {
            $model->attributes=$_POST['ContentBlock'];
            $model->name = $model->title_ru ? $model->title_ru : uniqid();
            if($model->save())
                if ($model->category == ContentBlock::REALTY){
                    $this->redirect(['admin']);
                } elseif ($model->category == ContentBlock::PARTNERS){
                    $this->redirect(['admin', 'active_tab'=> 'tab2']);
                }
        }
        $model->type = ContentBlock::SIMPLE_TEXT;
        $model_realty = clone $model;
        $model_partners = clone $model;
        $model_realty->category = ContentBlock::REALTY;
        $model_partners->category = ContentBlock::PARTNERS;

        if ($model->category == ContentBlock::REALTY){
            $active_tab = 'tab1';
        } elseif ($model->category == ContentBlock::PARTNERS){
            $active_tab = 'tab2';
        }

        $this->render('create',array(
            'model'=>$model,
            'model_realty'=>$model_realty,
            'model_partners'=>$model_partners,
            'active_tab' => $active_tab,
        ));
    }*/

    public function actionCreateRealty()
    {
        $model=new ContentBlock;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ContentBlock']))
        {
            $model->attributes=$_POST['ContentBlock'];
            $model->name = $model->title_ru ? $model->title_ru : uniqid();
            if($model->save())
                    $this->redirect(['adminRealty']);
        }
        $model->type = ContentBlock::SIMPLE_TEXT;
        $model->category = ContentBlock::REALTY;

        $this->render('create_realty',array(
            'model'=>$model,
        ));
    }

    public function actionCreatePartners()
    {
        $model=new ContentBlock;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ContentBlock']))
        {
            $model->attributes=$_POST['ContentBlock'];
            $model->name = $model->title_ru ? $model->title_ru : uniqid();
            if($model->save())
                    $this->redirect(['adminPartners']);
        }
        $model->type = ContentBlock::SIMPLE_TEXT;
        $model->category = ContentBlock::PARTNERS;

        $this->render('create_partners',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    /*public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ContentBlock']))
        {
            $model->attributes=$_POST['ContentBlock'];
            $model->name = $model->title_ru ? $model->title_ru : uniqid();
            if($model->save()){
                if ($model->category == ContentBlock::REALTY){
                    $this->redirect(['admin']);
                } elseif ($model->category == ContentBlock::PARTNERS){
                    $this->redirect(['admin', 'active_tab'=> 'tab2']);
                }
            }
        }

        $model_realty = clone $model;
        $model_partners = clone $model;
        $model_realty->category = ContentBlock::REALTY;
        $model_partners->category = ContentBlock::PARTNERS;

        if ($model->category == ContentBlock::REALTY){
            $active_tab = 'tab1';
        } elseif ($model->category == ContentBlock::PARTNERS){
            $active_tab = 'tab2';
        }

        $this->render('update',array(
            'model'=>$model,
            'model_realty'=>$model_realty,
            'model_partners'=>$model_partners,
            'active_tab' => $active_tab,
        ));
    }*/

    public function actionUpdateRealty($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ContentBlock']))
        {
            $model->attributes=$_POST['ContentBlock'];
            $model->name = $model->title_ru ? $model->title_ru : uniqid();
            if($model->save()){
                    $this->redirect(['adminRealty']);
            }
        }

        $this->render('update_realty',array(
            'model'=>$model,
        ));
    }

    public function actionUpdatePartners($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ContentBlock']))
        {
            $model->attributes=$_POST['ContentBlock'];
            $model->name = $model->title_ru ? $model->title_ru : uniqid();
            if($model->save()){
                    $this->redirect(['adminPartners']);
            }
        }

        $this->render('update_partners',array(
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
    /*public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('ContentBlock');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    /*
    /**
     * Manages all models.
     */
	public function actionAdminRealty()
	{
		$model=new ContentBlock('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ContentBlock'])){
            $model->attributes=$_GET['ContentBlock'];
        }
        $model->category = ContentBlock::REALTY;

		$this->render('admin_realty',array(
			'model'=>$model,
        ));
	}

	public function actionAdminPartners()
	{
		$model=new ContentBlock('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ContentBlock'])){
            $model->attributes=$_GET['ContentBlock'];
        }
        $model->category = ContentBlock::PARTNERS;

		$this->render('admin_partners',array(
			'model'=>$model,
            'label' => 'партнеры',
            'label_Big' => 'Партнеры',
        ));
	}

    /**
     * @param $id
     * @return array|mixed|null
     * @throws CHttpException
     */
	public function loadModel($id)
	{
		$model=ContentBlock::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ContentBlock $model the model to be validated
	 */
	public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='content-block-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
