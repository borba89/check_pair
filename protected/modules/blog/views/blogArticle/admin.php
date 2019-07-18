<?php
    $label = $model->isNewRecord ? "Создать" : "Сохранить";
    Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);

	$this->breadcrumbs=array(
        'Articles'=>array('admin'),
        'Manage',
    );

    $this->menu=array(
        array('label'=>'Категории','url'=>array('/blog/category/admin'), 'visible'=>Yii::app()->user->isAdmin || Yii::app()->user->isContentManager),
        array('label'=>'Комментарии','url'=>array('/backend/comment/admin')),
        array('label'=>'Создать статью','url'=>array('create'), 'visible'=>Yii::app()->user->isAdmin || Yii::app()->user->isContentManager),
        array('label'=>'Создать Категорию','url'=>array('/blog/category/create'), 'visible'=>Yii::app()->user->isAdmin || Yii::app()->user->isContentManager),
    );
    $this->title = "Новостные статьи";
    $this->renderPartial('_search', array('model' => $model));
?>

<?php Yii::app()->clientScript->registerScript('form-id-var', "
    var form_id = 'blog-article-list';
    var ajax_url = '".$this->createUrl('/blog/blogArticle/admin')."';
", CClientScript::POS_BEGIN); ?>

<?php Yii::app()->clientScript->registerScript('search', "
    $('.dropdown-filter').change(function(){
        $.fn.yiiListView.update('blog-article-list', {
            data: $('.search-tabs-header form').serialize()
        });
        return false;
    });
"); ?>

<?php $this->widget(
    'backend.widgets.YListView',
    array(
        'id' => 'blog-article-list',
        'dataProvider' => $model->search(),
        'itemView' => '_blog_grid',
        'template' => '{summary}{items}{pager}',
        'itemsTagName' => 'ul',
        'itemsCssClass' => 'mt-productlisthold list-inline',
        'enableHistory' => true,
        'cssFile' => false,
        'ajaxUpdate'=>true,
        'sortableAttributes'=>array(
            'created',
            'title',
        ),
        'emptyText' => '<div class="col-xs-12 pb30"><div class="alert alert-info" role="alert">'.Yii::t("base", "No results").'</div></div>'
    )
); ?>
