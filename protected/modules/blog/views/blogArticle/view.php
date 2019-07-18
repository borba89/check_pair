<?php
    $label = $model->isNewRecord ? "Создать" : "Сохранить";
    Yii::app()->clientScript->registerScript('button-label', '
                var buttonLabel = \'' . $label . '\'
            ', CClientScript::POS_HEAD);

	$this->breadcrumbs=array(
        'Blog Articles'=>array('admin'),
        $model->id,
    );

    $this->menuModel = $model;
    $this->activeAddress = Yii::app()->createUrl('/blog/blogArticle/lotToggle', array('id' => $model->id));
    $this->menu=array(
        array('label'=>'Назад','url'=>array('admin')),
        array('label'=>'Снять статью','url'=>'',
            'linkOptions'=>array('id' => 'closeLot'),
            'visible'=>(Yii::app()->user->checkAccess(User::ADMIN) || Yii::app()->user->checkAccess(User::CONTENT_MANAGER))
        ),
        array('label'=>'Разместить статью','url'=>'',
            'linkOptions'=>array('id' => 'openLot'),
            'visible'=>(Yii::app()->user->checkAccess(User::ADMIN) || Yii::app()->user->checkAccess(User::CONTENT_MANAGER))
        ),
        array('label'=>'Исправить статью','url'=>array('update','id'=>$model->id), 'linkOptions'=>array('id' => 'updateLot'), 'visible'=>(Yii::app()->user->checkAccess(User::ADMIN) || Yii::app()->user->checkAccess(User::CONTENT_MANAGER))),
        array('label'=>'Удалить статью','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Статья будет удалена и вы не сможете восстановить её позже. Пожалуйста, подтвердите операцию', 'id' => 'deleteLot'), 'visible'=>(Yii::app()->user->checkAccess(User::ADMIN) || Yii::app()->user->checkAccess(User::CONTENT_MANAGER))),
    );
    $this->title = "Просмотр: ". $model->title;
?>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
    array(
        'name' => Yii::t("BlogModule.blog", 'Пользователь'),
        'type' => 'user',
        'value' => function($data) {
            return $data->author;
        },
    ),
    'title',
    'subtitle',
    'content',
    'image:image',
    'is_active:boolean',
    'created:dateTime',
    'updated:dateTime',
    'language',
    'views',
),
)); ?>
