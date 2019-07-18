<?php $form = $this->beginWidget('backend.components.ActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'inputContainer' => '.input-field',
    ),
    'type'=>'horizontal',
    'htmlOptions' => array('class' =>'form-horizontal row-border', "enctype"=>"multipart/form-data"),
)); ?>

    <?php echo CHtml::image($model->getAvatarSrc(), '', array('width'=>128));?>


    <?php echo $form->fileFieldGroup($model,'photo',array('class'=>'required','maxlength'=>255)); ?>

    <?php echo $form->textFieldGroup($model,'name'); ?>

    <?php echo $form->textFieldGroup($model,'surname'); ?>

    <?php echo $form->textFieldGroup($model,'email'); ?>

    <?php echo $form->dropDownListGroup($model,'role', User::model()->getAllRoles(), array('class'=>'required','maxlength'=>1)); ?>

    <?php if($model->isNewRecord) : ?>
        <?php echo $form->passwordFieldGroup($model,'password',array('class'=>'span5','maxlength'=>64)); ?>
        <?php echo $form->passwordFieldGroup($model,'password_repeat',array('class'=>'span5','maxlength'=>64)); ?>
    <?php endif; ?>

    <div class="clearfix"></div>

    <div id="box-phones-broker" class="well clearfix" <?php if($model->isNewRecord):?>style="display: none;"<?php elseif (!$model->isNewRecord && $model->role != User::BROCKER):?>style="display: none;"<?php endif;?>>

        <h6 class="input-field col s8">Номера телефонов</h6>

        <?php if($model->role == User::BROCKER && !$model->isNewRecord):?>
        <?php foreach ($model->phones as $phone) {
            echo '<div class="input-field col s12 rm-num-'.$phone->id.'" style="overflow: hidden;">';
                echo '<div class="btnMinus" onclick="rmPhoneInput('.$phone->id.')" 
style="float: right; margin-top:10px;border: 0px none; background-image: url(\'/img/remove.png\'); background-position: center center; background-repeat: no-repeat; height: 25px; width: 25px;" ></div>';
                echo $form->textFieldGroup($phones,'phone[]', array(
                    'widgetOptions'=>array(
                            'htmlOptions'=>array(
                                    'labelOverride'=>'Номер телефона',
                                    'value'=>$phone->phone,
                            ),
                    ),
                    'groupOptions'=>array(
                            'class'=>'input-field col s8'
                    )
                ));
            echo '</div>';
        }?>
        <?php endif;?>

        <div class="clearfix"></div>

        <div id="czContainer">
            <div id="first">
                <div class="recordset" style="padding: 10px;">
                    <?php echo $form->textFieldGroup($phones,'phone[]', array(
                            'widgetOptions'=>array(
                                'htmlOptions'=>array(
                                    'labelOverride'=>'Номер телефона'
                                ),
                            ),
                        'groupOptions'=>array(
                            'class'=>'input-field col s8'
                        )
                    )); ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br><br><br><br>
    </div>

    <div class="clearfix"></div>

    <?php echo $form->checkboxGroup($model, 'is_active',
        array('widgetOptions' =>
            array(
                'htmlOptions' => array(
                    'checked' => $model->isNewRecord ? true : $model->is_active,
                ),
            ),
            'labelOptions' => array(
                'for' =>  CHtml::activeId($model, 'is_active'),
            )
        )
    ); ?>

    <?php $this->widget('backend.widgets.YButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'waves-effect waves-light m-b-xs'),
        'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>


<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('backend.assets.js').'/jquery.czMore-latest.js'
    ),
    CClientScript::POS_HEAD
);

$js = <<<JS
$('#User_role').on('change', function(event) {
    var role = $(this).val();
    console.log($(this).val());
    if(role == 'broker'){
        $('#box-phones-broker').show();
    }else {
        $('#box-phones-broker').hide();
    }
});

function rmPhoneInput(id) {
  $('.rm-num-'+id).remove();
}
JS;

$jsReady = <<<JS
$("#czContainer").czMore();
JS;

Yii::app()->clientScript->registerScript('czMore_phones', $jsReady, CClientScript::POS_END);
Yii::app()->clientScript->registerScript('tabular_form_phones', $js, CClientScript::POS_END);
?>
