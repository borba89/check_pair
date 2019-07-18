<?php
/* @var $this DistrictController */
/* @var $model CityDistrict */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-district-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">

        <?php if($model->isNewRecord):?>
            <?php echo $form->labelEx($model,'city_id'); ?>
		    <?php echo $form->dropDownList($model,'city_id', CityDistrict::getCities()); ?>
            <?php echo $form->error($model,'city_id'); ?>
        <?php else:?>
            <?php echo $form->hiddenField($model,'city_id'); ?>
        <?php endif;?>

	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district_en'); ?>
		<?php echo $form->textField($model,'district_en',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'district_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district_ru'); ?>
		<?php echo $form->textField($model,'district_ru',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'district_ru'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district_ro'); ?>
		<?php echo $form->textField($model,'district_ro',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'district_ro'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'suburb'); */?><!--
		<?php /*echo $form->checkBox($model,'suburb'); */?>
		--><?php /*echo $form->error($model,'suburb'); */?>

        <div class="col s12">
            <!-- Switch -->
            <div class="switch m-b-md">
                <label>
                    <?php echo Yii::t('BackendModule.backend', 'Район');?>
                    <input type="hidden" name="CityDistrict[suburb]" value="0">
                    <input type="checkbox" name="CityDistrict[suburb]" value="1" <?php echo ($model->suburb)?'checked':'';?>>
                    <span class="lever"></span>
                    <?php echo Yii::t('BackendModule.backend', 'Пригород');?>
                </label>
            </div>
        </div>

	</div>

	<div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-primary'),
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->