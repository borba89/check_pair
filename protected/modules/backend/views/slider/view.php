<?php
/* @var $this SliderController */
/* @var $model Slider */
$this->title = Yii::t('BackendModule.backend', 'Слайд ').'#'.$model->id;
$this->breadcrumbs=array(
    Yii::t('BackendModule.backend', 'Слайдер')=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('BackendModule.backend', 'Добавить слайд'), 'url'=>array('create')),
	array('label'=>Yii::t('BackendModule.backend', 'Редактировать слайд'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('BackendModule.backend', 'Удалить слайд'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('BackendModule.backend', 'Слайдер'), 'url'=>array('admin')),
);
?>

<div class="hero-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-6">
				<div class="hero-slide">
					<div class="hero-single-slide">
						<h1><?php echo $model->title;?></h1>
						<h4><?php echo $model->content;?></h4>
						<a class="header-global-btn" href="#"><?php echo Yii::t('MainModule.main', 'Вся недвижимость')?></a>
						<a href="tel:<?php echo $model->companyPhone;?>"><?php echo Yii::t('BackendModule.backend', 'Call')?>: <?php echo $model->companyPhone;?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--  hero area end -->