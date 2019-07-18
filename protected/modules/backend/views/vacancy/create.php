<?php
/* @var $this VacancyController */
/* @var $model Vacancy */
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                    var buttonLabel = \'' . $label . '\'
                ', CClientScript::POS_HEAD);

$this->title = Yii::t('BackendModule.backend','Создание вакансии');

$this->breadcrumbs=array(
	'Vacancies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Отмена', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>