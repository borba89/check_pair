<?php $form = new ActiveForm();
$form->id = 'blog-article-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
);
$form->type = 'horizontal';
?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'project_type',
    BuildingProject::getAllProjectTypes(),
    array('class'=>'required')
); ?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'building_type',
    BuildingTypes::getTypes(),
    array('class'=>'required')
); ?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'apartment_position',
    RealtyDetailedDescription::model()->getPositions(),
    array('class'=>'required')
); ?>

<?php
//    echo $form->textFieldGroup(
//    $realtyDetailed,
//    'total_space_size',
//    [ 'groupOptions' => ['class' => ' m6 input-field col s12']]);
?>

<?php echo $form->maskField($realtyDetailed,'floor',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php echo $form->maskField($realtyDetailed,'total_space_size',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'space_size_units',
    RealtyDetailedDescription::model()->getSpaseSizeUnits(),
    array('class'=>'required', 'prompt' => 'Select space size unit'));
?>

<?php
//    echo $form->textFieldGroup(
//    $realtyDetailed,
//    'floor',
//    ['class'=>'required', 'groupOptions' => ['class' => ' m6 input-field col s12']]);
?>

<?php
//echo $form->textFieldGroup($realtyDetailed,
//    'number_of_floors',
//    ['class'=>'required', 'groupOptions' => ['class' => ' m6 input-field col s12']]);
?>

<?php echo $form->maskField($realtyDetailed,'number_of_floors',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php
//  echo $form->textFieldGroup(
//    $realtyDetailed,
//    'rooms',
//    array('class'=>'required')
//);
?>

<?php echo $form->maskField($realtyDetailed,'rooms',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'space_conditions',
    RealtyDetailedDescription::model()->getSpaseConditions(),
    array('class'=>'required', 'prompt' => 'Select space size unit')
); ?>

<?php
//echo $form->textFieldGroup(
//    $realtyDetailed,
//    'num_balcony',
//    array('class'=>'required')
//);
?>

<?php echo $form->maskField($realtyDetailed,'num_balcony',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php
// echo $form->checkboxGroup($realtyDetailed, 'newly_built',
//    array('widgetOptions' =>
//        array(
//            'htmlOptions' => array(
//                'checked'=>$realtyDetailed->newly_built ? true : $realtyDetailed->newly_built
//            ),
//        ),
//        'labelOptions' => array(
//            'for' =>  CHtml::activeId($realtyDetailed, 'newly_built'),
//        )
//    )
//);
// echo $form->switchGroup($realtyDetailed, 'newly_built',
//    array('widgetOptions' =>
//        array(
//            'htmlOptions' => array(
//                'onText' => 'вкл',
//                'offText' => 'выкл'
//            ),
//        ),
//        'labelOptions' => array(
//            'for' =>  CHtml::activeId($realtyDetailed, 'newly_built'),
//        )
//    )
//);


?>
<div class=" m6 input-field col s12">
    <?php echo $form->label($realtyDetailed, 'newly_built', array('class'=>'active')); ?>
    <div class="switch switch-form-control">
    <label>
        <?php echo Yii::t("base","Нет"); ?>
        <?php echo $form->checkBox($realtyDetailed, 'newly_built') ?>
        <span class="lever"></span>
        <?php echo Yii::t("base","Да"); ?>
    </label>
    </div>
</div>

<script type="text/javascript">
    $().ready(function () {
        var settings = $('#blog-article-form').data('settings');
        var new_settings = '<?php echo json_encode(array_values($form->attributes)); ?>';

        console.log(settings);
        if (new_settings != "" && settings) {
            new_settings = eval(new_settings);
            $.each(new_settings, function (i) {
                settings.attributes.push(
                    new_settings[i]
                );
            });

            $.each(settings.attributes, function (i) {
                settings.attributes[i] = $.extend({}, {
                    validationDelay: settings.validationDelay,
                    validateOnChange: settings.validateOnChange,
                    validateOnType: settings.validateOnType,
                    hideErrorMessage: settings.hideErrorMessage,
                    inputContainer: settings.inputContainer,
                    errorCssClass: settings.errorCssClass,
                    successCssClass: settings.successCssClass,
                    beforeValidateAttribute: settings.beforeValidateAttribute,
                    afterValidateAttribute: settings.afterValidateAttribute,
                    validatingCssClass: settings.validatingCssClass
                }, this);
            });
            $('#blog-article-form').data('settings', settings);
        }

        $('select').material_select();
    });
</script>