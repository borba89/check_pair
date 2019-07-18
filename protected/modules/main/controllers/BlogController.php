<?php
Yii::import('main.components.Frontend');
Yii::import('blog.models.*');
class BlogController extends Frontend
{
    public $apiClass;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'single', 'category','search'),
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
        $categories = ArticleCategory::model()->findAll();
        $this->render('articles', array(
            'blog' => $blog,
            'categories'=>$categories
        ));
    }

    public function actionCategory($id)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('category_id', $id);

        $blog = $this->apiClass->getBlogs($criteria);
        $categories = ArticleCategory::model()->findAll();
        $this->render('articles', array(
            'blog' => $blog,
            'categories'=>$categories
        ));
    }

    public function actionSingle($id = null)
    {
        $this->footer_phone = true;
        $blog = $this->apiClass->getBlog($id);
		
		$categories = ArticleCategory::model()->findAll();
        if (!$blog) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        $this->render('single', array(
            'blog' => $blog,
            'categories'=>$categories
        ));
    }

    public function actionSearch($q)
    {
        $query = CHtml::encode($q);

        $categories = ArticleCategory::model()->findAll();

        $blog = BlogArticle::model()->frontSearch($query);

        $this->render('articles', array(
            'blog' => $blog,
            'categories'=>$categories
        ));
    }
}