<?php
/* @var $this EmailTemplateController */
/* @var $model EmailTemplate */
$this->title = Yii::t('BackendModule.backend', 'Просмотр шаблона').': '.$model->name;
$this->breadcrumbs=array(
	'Email Templates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Шаблоны писем'), 'url'=>array('admin')),
	array('label'=>Yii::t('BackendModule.backend', 'Добавить шаблон'), 'url'=>array('create')),
	array('label'=>Yii::t('BackendModule.backend', 'Редактировать шаблон'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('BackendModule.backend', 'Удалить шаблон'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h3><?php echo $model->name;?></h3>

<ul class="collection">
	<li class="collection-item">
		<div class="col s12">
			<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
				<li class="tab col s3"><a href="#test1" class="">Русский</a></li>
				<li class="tab col s3"><a class="" href="#test2">Молдавский</a></li>
				<li class="tab col s3"><a href="#test3">Английский</a></li>
				<div class="indicator" style="right: 0px; left: 397.5px;"></div>
			</ul>
			<p class="clearfix"></p>
			<div id="test1" class="col s12">
                <br><br>
                <div class="clearfix">Тема: <?php echo $model->subject_ru; ?></div>
                <div class="card white darken-1">
                    <div class="card-content" style="text-align: center;">
                        <?php $this->renderPartial('_preview', array('content'=>$model->message_ru)); ?>
                    </div>
				</div>
			</div>
			<div id="test2" class="col s12" style="display: none;">
                <br><br>
                <div class="clearfix">Тема: <?php echo $model->subject_ro; ?></div>
				<div class="clearfix"></div>
                <div class="card white darken-1">
                    <div class="card-content">
                        <?php $this->renderPartial('_preview', array('content'=>$model->message_ro)); ?>
                    </div>
                </div>
			</div>
			<div id="test3" class="col s12" style="display: none;">
                <br><br>
                <div class="clearfix">Тема: <?php echo $model->subject_en; ?></div>
				<div class="clearfix"></div>
                <div class="card white darken-1">
                    <div class="card-content">
                        <?php $this->renderPartial('_preview', array('content'=>$model->message_en)); ?>
                    </div>
                </div>
			</div>
		</div>
	</li>
</ul>
