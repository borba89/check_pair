<?php
/* @var $this AuctionController */
/* @var $model Auction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'auction-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model, 'offer_id', array('value' => $model->offer_id)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'start_bids'); ?>
		<?php echo $form->textField($model,'start_bids'); ?>
		<?php echo $form->error($model,'start_bids'); ?>
	</div>

	<div class="row">
		<?php
        $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
            'model' => $model,
            'attribute' => 'end_date',
            'options' => array(
                'lang'=>'ru',
                'i18n'=>array(
                    'ru'=>array(
                        'months'=>array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'),
                    )
                ),
                'format'=>'Y-m-d H:i'
            ),
            'htmlOptions' => array(),
        ));

        //echo $form->labelEx($model,'end_date'); ?>
		<?php //echo $form->datePickerGroup($model,'end_date'); ?>
		<?php //echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">

		<?php echo $form->checkBox($model,'status'); ?>
        <?php echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->error($model,'status'); ?>
	</div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-primary'),
            'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->