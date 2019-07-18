<?php
Yii::import('backend.components.WebModule');
Yii::import('blog.models.BlogArticle');

class BlogModule extends WebModule
{
    public $_localAssetsUrl;

    public function init()
    {
        parent::init();
        $this->setImport(array(
            'blog.models.*',
            'blog.components.*',
            'blog.widgets.*',
            'offer.models.*',
        ));
    }

    public static function menuItem()
    {
        return array(
            'icon' => 'subject',
            'label' => Yii::t('BlogModule.blog', 'Новостные статьи'),
            'url' => Yii::app()->createUrl("blog/blogArticle/admin"),
            'sidebar_tab' => 'blog-article',
            'position' => 4,
        );
    }

    public static function statisticBlock()
    {
        return array(
            array(
                'title' => 'Articles list',
                'value' => BlogArticle::model()->count(),
                'descpiption' => 'Article count',
            ),
        );
    }

    public static function urlRules()
    {
        return array(
        );
    }
}