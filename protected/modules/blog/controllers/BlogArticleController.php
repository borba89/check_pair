<?php
Yii::import('backend.components.BackendController');

class BlogArticleController extends BackendController
{

    public $sidebar_tab = "blog-article";

    protected function beforeAction($action)
    {
        if($action == 'create' || $action == 'update' || $action == 'delete') {
            if(Yii::app()->user->checkAccess(User::ADMIN) || Yii::app()->user->checkAccess(User::CONTENT_MANAGER)){
                return true;
            }else{
                Yii::app()->request->redirect(Yii::app()->user->returnUrl);
            }
        }else {
            return true;
        }
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
            return new BlogArticle($step);
        } else {
            return new BlogArticle();
        }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=BlogArticle::model()->findByPk($id);

        if ($step = Yii::app()->request->getParam('step', null)) {
            $model->scenario = $step;
        }

		if ($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	public function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='blog-article-form')
		{
			$ret = CActiveForm::validate($model);

            if (isset($_POST['step']) && $_POST['step'] == 'step1' && $ret == '[]') {
                $ret = array();
                $post = $_POST['BlogArticle'];

                if ($model->image && !isset($post['image_remove']) && !isset($post['image'])) {
                    $post['image'] = $model->image;
                }

                $ret['type'] = 'preview';
                $ret['content'] = $this->renderPartial('blog.views.blogArticle._preview', $post, true);
                $ret = json_encode($ret);
            }

            echo $ret;
			Yii::app()->end();
		}
	}

    public function actionSuggest() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $criteria = new CDbCriteria;
            $criteria->compare('title', $_GET['term'], true);
            $models = BlogArticle::model()->findAll($criteria);
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
            $realty = BlogArticle::model()->findByPk($id);
            if ($realty) {
                $realty->is_active = ($realty->is_active == 1)
                    ? 0 : 1;
                if ($realty->saveAttributes(array('is_active'))) {
                    Yii::app()->ajax->success();
                }
            }

            Yii::app()->ajax->failure();
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }
}