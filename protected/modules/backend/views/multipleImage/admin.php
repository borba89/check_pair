<?php
    $this->breadcrumbs=array(
        Yii::t("backend", 'Album Images')=>array('admin'),
        'Manage',
    );
    $this->title = Yii::t("backend", "Manage Album Image");
    $this->menu=array(
        array('label'=>Yii::t("backend", 'Create AlbumImage'),'url'=>array('create')),
    );
?>

<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'album-image-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'item_id',
        array(
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'author',
            'editable' => array(
                'type' => 'text',
                'url' => $this->createUrl('multipleImage/authorUpdate'),
                'placement' => 'right',
            )
        ),
        array(
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'title_ro',
            'editable' => array(
                'type' => 'text',
                'url' => $this->createUrl('multipleImage/titleUpdate'),
                'placement' => 'left',
            )
        ),
        array(
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'title_ru',
            'editable' => array(
                'type' => 'text',
                'url' => $this->createUrl('multipleImage/titleUpdate'),
                'placement' => 'right',
            )
        ),
		'path:image',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '70px'),
        ),
	),
)); ?>
