<?php
    $this->title = 'Manage General Settings';
    $this->breadcrumbs=array(
        'General Settings'=>array('admin', 'id' => Settings::GENERAL),
        'Manage',
    );
$this->menu=array(
    array('label'=>'Create General Setting','url'=>array('create')),
);
?>

<?php $this->widget('application.components.CmTabView', array(
    'htmlOptions'=>array(
        'class'=>'col s12'
    ),
    'activeTab'=>'tab1',
    'tabs'=>array(
        'tab1'=>array(
            'title'=>' Уведомление о заказанном звонке',
            'view'=>'_mail_grid_view',
            'data'=>array('model'=>$model),
        ),
        'tab2'=>array(
            'title'=>'Уведомление об участии в аукционе',
            'url'=>'auction',
        ),
    ),
)); ?>

