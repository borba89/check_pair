<?php
/* @var $this SliderController */
/* @var $model Slider */
$this->title = Yii::t('BackendModule.backend', 'Строительные серии домов');

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Добавить Серию'), 'url'=>array('create'), 'linkOptions' => ['class' => 'btn-success-custom ']),
);
?>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
	<li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'Справочники')?></a></li>
	<li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Строительные серии')?></li>
</ol>

<div class="grid-view-filter-custom">
    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'building-project-grid',
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
                'header' => Yii::t("RealtyModule.realty", 'Строительная серия дома'),
                'name' => 'title_'.Yii::app()->language,
                'value' => '$data->title',
                'type'=>'raw',
                'htmlOptions' => array('style'=>'text-align:center;'),
                'headerHtmlOptions'=>array(
                    'style'=>'text-align:center;'
                ),
            ],
            array(
                'class' => 'backend.components.ButtonColumn',
                'htmlOptions' => array('width' => '80px'),
                'template'=>'{update} {delete}',
            ),
        ),
    )); ?>
</div>