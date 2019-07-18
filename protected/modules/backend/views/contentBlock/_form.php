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

    <?php if (0) : ?>
<!--    <div class="row">-->
<!--        --><?php //echo $form->labelEx($model,'category'); ?>
<!--        --><?php //echo $form->dropDownList($model,'category',$model->getCategories(), array('class'=>'required active')); ?>
<!--        --><?php //echo $form->error($model,'category'); ?>
<!--    </div>-->
<!---->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'name'); ?>
<!--		--><?php //echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
<!--		--><?php //echo $form->error($model,'name'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'description'); ?>
<!--		--><?php //echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
<!--		--><?php //echo $form->error($model,'description'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'code'); ?>
<!--		--><?php //echo $form->textField($model,'code',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'code'); ?>
<!--	</div>-->


<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'type'); ?>
<!--		--><?php //echo $form->dropDownList($model,'type', $model->getTypes()); ?>
<!--		--><?php //echo $form->error($model,'type'); ?>
<!--	</div>-->
    <?php endif; ?>

    <?php echo $form->hiddenField($model, 'category', ['value' => $model->category]); ?>
    <?php echo $form->hiddenField($model, 'type', ['value' => $model->type]); ?>

    <?php echo $form->fileFieldGroup($model, 'image', array('class'=>'required','maxlength'=>255)); ?>
    <div class=" m6 input-field col s12">
        124х85 px
    </div>
    <div class="clearfix" style="height: 10px"></div>

    <ul class="collection">
        <li class="collection-item">
            <div class="col s12">
                <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                    <li class="tab col s3"><a href="#test1" class=""><?php echo Yii::t('BackendModule.backend', 'Русский')?></a></li>
                    <li class="tab col s3"><a class="" href="#test2"><?php echo Yii::t('BackendModule.backend', 'Молдавский')?></a></li>
                    <li class="tab col s3"><a href="#test3"><?php echo Yii::t('BackendModule.backend', 'Английский')?></a></li>
                    <div class="indicator" style="right: 0px; left: 397.5px;"></div>
                </ul>
                <p class="clearfix" style="height: 10px;"></p>
                <div id="test1" class="col s12">
                    <?php echo $form->textFieldGroup($model, 'title_ru'); ?>
                    <div class="clearfix"></div>
                    <?php echo $form->textAreaGroup($model, 'content_ru',
                        ['widgetOptions' =>
                            ['htmlOptions' =>
                                ['class'=> 'textarea-like-input']]]
                    ); ?>
                    <?php
//                    $this->widget('ext.tinymce.TinyMce', array(
//                        'model' => $model,
//                        'attribute' => 'content_ru',
//                        'settings'=>array(
//                            'menubar' => "file edit view",
//                            'toolbar' => 'undo redo',
//                        ),
//                        'htmlOptions' => array(
//                            'rows' => 6,
//                            'cols' => 60,
//                        ),
//                    ));
                    ?>
                </div>
                <div id="test2" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
                    <div class="clearfix"></div>
                    <?php echo $form->textAreaGroup($model, 'content_ro',
                        ['widgetOptions' =>
                            ['htmlOptions' =>
                                ['class'=> 'textarea-like-input']]]
                    ); ?>
                    <?php
//                    $this->widget('ext.tinymce.TinyMce', array(
//                        'model' => $model,
//                        'attribute' => 'content_ro',
//                        'settings'=>array(
//                            'menubar' => "file edit view",
//                            'toolbar' => 'undo redo',
//                        ),
//                        'htmlOptions' => array(
//                            'rows' => 6,
//                            'cols' => 60,
//                        ),
//                    ));
                    ?>
                </div>
                <div id="test3" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'title_en'); ?>
                    <div class="clearfix"></div>
                    <?php echo $form->textAreaGroup($model, 'content_en',
                        ['widgetOptions' =>
                            ['htmlOptions' =>
                                ['class'=> 'textarea-like-input']]]
                    ); ?>
                    <?php
//                    $this->widget('ext.tinymce.TinyMce', array(
//                        'model' => $model,
//                        'attribute' => 'content_en',
//                        'settings'=>array(
//                            'menubar' => "file edit view",
//                            'toolbar' => 'undo redo',
//                        ),
//                        'htmlOptions' => array(
//                            'rows' => 6,
//                            'cols' => 60,
//                        ),
//                    ));
                    ?>
                </div>
            </div>
        </li>
    </ul>

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