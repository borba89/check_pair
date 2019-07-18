<?php
/* @var $this ContentBlockController */
/* @var $model ContentBlock */
/* @var $form CActiveForm */
?>

    <div class="wizard-content realty-content collection-no-border">

        <?php $form=$this->beginWidget('backend.components.ActiveForm', array(
            'id'=>'content-block-form',
            'enableAjaxValidation'=>false,
            'type'=>'horizontal',
            'htmlOptions' => array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
        )); ?>


        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->hiddenField($model, 'category', ['value' => $model->category]); ?>
        <?php echo $form->hiddenField($model, 'type', ['value' => $model->type]); ?>

        <?php
        echo $form->fileFieldGroup($model, 'image',
        [
            'class'=>'required',
            'maxlength'=>255,
            'label' => Yii::t('BackendModule.backend','Логотип'),
        ]);
        ?>
        <div class=" m6 input-field col s12">
            124х85 px
        </div>
        <div class="clearfix" style="height: 10px"></div>
        <?php echo $form->textFieldGroup($model, 'name',[
            'widgetOptions' => [
                'htmlOptions' => ['labelOverride' => Yii::t('BackendModule.backend','Название партнера')],
        ]])
        ?>

        <div class="row buttons">
            <?php $this->widget('booster.widgets.TbButton', array(
                'buttonType'=>'formSubmit',
                'htmlOptions' => array('class' => 'btn btn-success-custom'),
                'label'=>$model->isNewRecord ? Yii::t('BackendModule.backend','Создать') : Yii::t('BackendModule.backend','Сохранить'),
            )); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php Yii::app()->clientScript->registerScript('realty-wizard', "$('select').material_select();", CClientScript::POS_READY); ?>