<?php
/* @var $this ContentBlockController */
/* @var $model ContentBlock */
//$label = $model->isNewRecord ? "Создать" : "Сохранить";
//Yii::app()->clientScript->registerScript('button-label', '
//                    var buttonLabel = \'' . $label . '\'
//                ', CClientScript::POS_HEAD);

$this->title = Yii::t('BackendModule.backend','Управление блоками контента - партнеры');

$this->breadcrumbs=array(
    Yii::t('BackendModule.backend','Блоки контента')=>array('admin'),
    Yii::t('BackendModule.backend','Управление'),
);

$this->menu=array(
    array('label'=>Yii::t('BackendModule.backend','Создать блок контента'), 'url'=>array('createPartners')),
    array('label'=>Yii::t('BackendModule.backend', 'Назад'), 'url'=>array('/backend/settings/pages', 'active_tab'=> 'tab1')),
);
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings') ?>"><?php echo Yii::t('BackendModule.backend', 'Настройки')?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages') ?>"><?php echo Yii::t('BackendModule.backend', 'Страницы-сайта')?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend/settings/pages', ['active_tab'=> 'tab1']) ?>"><?php echo Yii::t('BackendModule.backend', 'Стартовая')?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Партнеры')?></li>
</ol>

<div class="grid-view-filter-custom">
    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'content-block-partners-grid',
        'template' => '{items} {pager}',
        'dataProvider'=>$model->search(),
//    'ajaxUpdate'=>false,
        'filter'=>$model,
        'columns'=>array(
            [
                'name' => 'id',
                'htmlOptions' => ['width' => '60px', 'style'=>'text-align:center;'],
                'headerHtmlOptions'=>[
                    'width' => '60px',
                    'style'=>'text-align:center;'
                ],
            ],
            [
                'header' => $model->attributeLabels()['name'],
                'name' => 'title_'.Yii::app()->language,
                'value' => '$data->title',
                'type'=>'raw',
                'htmlOptions' => array('style'=>'text-align:center;'),
                'headerHtmlOptions'=>array(
//                'width' => '360px',
                    'style'=>'text-align:center;'
                ),
            ],
            /*
            'category',
            'description',
            'code',
            'type',

            'title_en',
            'title_ro',
            'title_ru',
            'content_en',
            'content_ro',
            'content_ru',
            */
            array(
                'class' => 'backend.components.ButtonColumn',
                'htmlOptions' => array('width' => '80px'),
                'template'=>'{update} {delete}',
                'buttons' => array(
                    'update' => array(
                        'url' => 'Yii::app()->createUrl("/backend/contentBlock/updatePartners", array("id"=>$data->id))',       // a PHP expression for generating the URL of the button
                    ),
                )

            ),
        ),
    )); ?>
</div>