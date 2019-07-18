<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php\n"; ?>
Yii::import('backend.components.BackendController');

class <?php echo $this->controllerClass; ?> extends BackendController
{
    public $sidebar_tab = "<?php echo $this->class2id($this->modelClass); ?>";

    public function actions()
    {
        return array(
            'admin'=>'DAdminAction',
            'view' => 'DViewAction',
            'create' => 'DCreateAction',
            'delete' => 'DDeleteAction',
            'update'=> 'DUpdateAction',
        );
    }

    public function createModel()
    {
        return new <?php echo $this->modelClass; ?>();
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
    public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}