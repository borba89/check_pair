<?php
/* @var $this CommentController */
/* @var $model Comment */
$this->title = Yii::t('BackendModule.backend', 'Комментарии');
$this->breadcrumbs=array(
	Yii::t('BackendModule.backend', 'Комментарии')=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Управление комментариями'), 'url'=>array('admin')),
);

?>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id'=>'comment-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        /*array(
            'name'=>'owner_name',
            'htmlOptions'=>array('width'=>50),
        ),*/
        array(
            'header'=>Yii::t('CommentsModule.msg', 'Статья'),
            'name'=>'owner_id',
            'value'=>'$data->ownerTitle',
            'htmlOptions'=>array('width'=>180),
        ),
        array(
            'header'=>Yii::t('CommentsModule.msg', 'Автор'),
            'value'=>'$data->userName',
            'htmlOptions'=>array('width'=>80),
        ),
        array(
            'header'=>Yii::t('CommentsModule.msg', 'Ссылка'),
            'value'=>'CHtml::link(CHtml::link(Yii::t("CommentsModule.msg", "Ссылка"), $data->pageUrl, array("target"=>"_blank")))',
            'type'=>'raw',
            'htmlOptions'=>array('width'=>80),
        ),
        array(
            'header'=>Yii::t('CommentsModule.msg', 'Комментарий'),
            'name'=>'comment_text',
        ),
        array(
            'header'=>Yii::t('CommentsModule.msg', 'Добавлен'),
            'name'=>'create_time',
            'type'=>'datetime',
            'htmlOptions'=>array('width'=>70),
            'filter'=>false,
        ),
        /*'update_time',*/
        array(
            'header'=>Yii::t('CommentsModule.msg', 'Статус'),
            'name'=>'status',
            'value'=>'$data->textStatus',
            'htmlOptions'=>array('width'=>50),
            'filter'=>Comment::model()->getStatuses(),
        ),
        array(
            'class'=>'backend.components.ButtonColumn',
            'deleteButtonImageUrl'=>false,
            'htmlOptions' => array('width' => '120px'),
            'buttons'=>array(
                'approve' => array(
                	'icon'=>'thumb_up',
                    'label'=>Yii::t('CommentsModule.msg', 'Одобрить'),
                    'url'=>'Yii::app()->urlManager->createUrl("/backend/comment/approve", array("id"=>$data->id))',
                    'options'=>array('style'=>'margin-right: 5px;'),
                    'click'=>'function(event){
                    				event.preventDefault();
                                    if(confirm("'.Yii::t('CommentsModule.msg', 'Одобрить комментарий?').'"))
                                    {
                                        $.post($(this).attr("href")).success(function(data){
                                            data = $.parseJSON(data);
                                            if(data["code"] === "success")
                                            {
                                                $.fn.yiiGridView.update("comment-grid");
                                            }
                                        });
                                    }
                                    return false;
                                }',
                ),
            ),
            'template'=>'{approve} {update} {delete}',
        ),
    ),
)); ?>