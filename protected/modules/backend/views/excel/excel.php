<?php
    $this->breadcrumbs=array(
        'Import user data',
    );

    $this->title = "Import user data";
?>



    <div class="alert alert-info">
        Only <strong>*.xls</strong> file format is supported by importer.
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $form=$this->beginWidget('backend.components.ActiveForm',array(
                'id'=>'category-form',
                'enableAjaxValidation'=>false,
                'type'=>'horizontal',
                'htmlOptions'=>array('class' =>'form-horizontal row-border', 'enctype'=>'multipart/form-data')
            )); ?>

            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->fileFieldGroup($model, 'file', array('class' => 'form-control')); ?>

            <?php echo CHtml::submitButton('Import', array('class' => 'btn btn-success')); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>

