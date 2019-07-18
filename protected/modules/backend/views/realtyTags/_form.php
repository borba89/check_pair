<?php
/* @var $form CActiveForm */

?>

<div class="form collection-no-border">

<?php $form=$this->beginWidget('backend.components.ActiveForm', array(
	'id'=>'realty-tags-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions'=>array('class' =>'form-horizontal row-border'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

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
                </div>
                <div id="test2" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'title_ro'); ?>
                </div>
                <div id="test3" class="col s12" style="display: none;">
                    <?php echo $form->textFieldGroup($model, 'title_en'); ?>
                </div>
            </div>
        </li>
    </ul>

    <?php if ($allTypes = Realty::model()->getRealtyType()): ?>

        <div class="input-field col s12 label-available-realty-type-for-tag">
            <?php echo Yii::t("MainModule.main", 'Доступно для') . ' :'; ?>
        </div>

        <div class="input-field col s12">

            <?php
            $model->realtyTypes = $model->getRealtyTypesChecked();
            foreach ($allTypes as $key => $type):
                ?>
                <div class="input-field">
                    <p>
                        <?php
                        echo $form->checkBox($model, 'realtyTypes[' . $key . ']');
                        echo $form->label($model, 'realtyTypes[' . $key . ']', array('class' => 'active label_checkbox_tag', 'label' => $type,));
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'formSubmit',
            'htmlOptions' => array('class' => 'btn btn-success-custom'),
            'label'=>$model->isNewRecord ? "Создать" : "Сохранить",
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->