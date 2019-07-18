<?php $this->widget(
    'backend.widgets.YListView',
    array(
        'id' => 'blog-article-list',
        'dataProvider' => $realty->search(),
        'itemView' => '_realty_grid',
        'template' => '{sorter}{summary}{items}{pager}',
        'itemsTagName' => 'ul',
        'itemsCssClass' => 'mt-productlisthold list-inline',
        'enableHistory' => true,
        'cssFile' => false,
        'ajaxUpdate'=>true,
        'viewData' => array(
            'realty' => $realty,
        ),
        'sortableAttributes'=>array(
            'created',
        ),
        'emptyText' => '<div class="col-xs-12 pb30"><div class="alert alert-info" role="alert">'.Yii::t("base", "No results").'</div></div>'
    )
); ?>