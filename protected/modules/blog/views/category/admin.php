<?php
/* @var $this CategoryController */
/* @var $model ArticleCategory */

$this->title = "Управление категориями";

$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Создать категорию', 'url'=>array('create')),
);

?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'article-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title_ru',
		'title_ro',
		'title_en',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '100px'),
            'template'=>' {update} {delete}'
        ),
	),
)); ?>
