<?php
    $this->breadcrumbs=array(
        'Custom Settings'=>array('admin', 'id' => Settings::CUSTOM),
        'Manage',
    );
    $this->title = 'Manage Custom Settings';
    if(Yii::app()->user->id == 1) {
        $this->menu=array(
            array('label'=>'Create Custom Setting','url'=>array('create')),
        );
    }
?>

<?php $this->widget('booster.widgets.TbGridView',array(
    'id'=>'settings-grid',
    'type' => 'striped bordered condensed',
    'dataProvider'=>$model->search(Settings::CUSTOM),
    'filter'=>null,
    'htmlOptions'=>array('style'=>'padding:0;'),
    'columns'=>array(
        array('name'=>'id','headerHtmlOptions'=>array('width'=>'40px')),
        'category',
        'key',
        array(
            'name'=>'value',
            'value'=>'Yii::app()->settings->get(Settings::GENERAL, $data->key)'
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template'=>'{view} {update}'
        ),
    ),
)); ?>
