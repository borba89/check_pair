<?php
Yii::import('main.components.Frontend');

class FrontController extends Frontend
{
    public $apiClass;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'single'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    protected function beforeAction($action)
    {
        $this->apiClass = Yii::createComponent('blog.models.ApiBlog');
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->footer_phone = true;
        $blog = $this->apiClass->getBlogs();
        $this->render('articles', array('blog' => $blog));
    }

    public function actionSingle($id = null)
    {
        $this->footer_phone = true;
        $blog = $this->apiClass->getBlog($id);

        if (!$blog) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        $this->render('single', array('blog' => $blog));
    }
}