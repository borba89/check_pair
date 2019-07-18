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
        array('label'=>'Исправить услугу','url'=>array('update','id'=>$model->id), 'linkOptions'=>array('id' => 'updateLot1')),
        array('label'=>'Удалить услугу','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Инфоблок будет удален и вы не сможете восстановить его позже. Пожалуйста, подтвердите операцию', 'id' => 'deleteLot1')),
    );
    $this->title = "Просмотр услуги # $model->id";
?>


<div class="col s12">
    <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
        <li class="tab col s3"><a href="#test1" class="">Русский</a></li>
        <li class="tab col s3"><a class="" href="#test2">Молдавский</a></li>
        <li class="tab col s3"><a href="#test3">Английский</a></li>
        <div class="indicator" style="right: 0px; left: 397.5px;"></div>
    </ul>

    <div id="test1" class="col s12">
        <?php $this->widget('booster.widgets.TbDetailView',array(
            'data'=>$model,
            'attributes'=>array(
                'title_ru',
                'text_ru',
                'image:image',
            ),
        )); ?>

    </div>
    <div id="test2" class="col s12" style="display: none;">
        <?php $this->widget('booster.widgets.TbDetailView',array(
            'data'=>$model,
            'attributes'=>array(
                'title_ro',
                'text_ro',
                'image:image',
            ),
        )); ?>
    </div>
    <div id="test3" class="col s12" style="display: none;">
        <?php $this->widget('booster.widgets.TbDetailView',array(
            'data'=>$model,
            'attributes'=>array(
                'title_en',
                'text_en',
                'image:image',
            ),
        )); ?>
    </div>
</div>
