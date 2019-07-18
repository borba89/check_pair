<?php
Yii::import('backend.components.BackendController');

class InfoBlockController extends BackendController
{
    public $sidebar_tab = "info";

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
            return new InfoBlock($step);
        } else {
            return new InfoBlock();
        }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = InfoBlock::model()->findByPk($id);

        if ($step = Yii::app()->request->getParam('step', null)) {
            $model->scenario = $step;
        }

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
        if(isset($_POST['ajax']) && $_POST['ajax']==='info-block-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSuggest() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $criteria = new CDbCriteria;
            $criteria->compare('title', $_GET['term'], true);
            $models = InfoBlock::model()->findAll($criteria);
            $result = array();
            if ($models) {
                foreach ($models as $m) {
                    $result[$m->title] = null;
                }
            }

            echo Yii::app()->ajax->raw($result);
        }
    }

    public function actionLotToggle() {
        if (Yii::app()->request->isPostRequest) {
            $id = Yii::app()->request->getQuery('id');
            $realty = InfoBlock::model()->findByPk($id);
            if ($realty) {
                $realty->is_active = ($realty->is_active == 1) ? 0 : 1;
                if ($realty->saveAttributes(array('is_active'))) {
                    Yii::app()->ajax->success();
                }
            }

            Yii::app()->ajax->failure();
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }
}