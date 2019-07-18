<?php $form = new ActiveForm();
$form->id = 'blog-article-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
);
$form->type = 'horizontal';
?>

<?php
//echo $form->textFieldGroup(
//    $realtyDetailed,
//    'parcel_size',
//    [ 'groupOptions' => ['class' => ' m6 input-field col s12']]);
?>

<?php echo $form->maskField($realtyDetailed,'parcel_size',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php echo $form->dropDownListGroup($realtyDetailed, 'parcel_size_unit', RealtyDetailedDescription::model()->getParcelSizeUnit(), array('class'=>'required', 'prompt' => 'Select size unit')); ?>

<?php
//echo $form->textFieldGroup(
//    $realtyDetailed,
//    'living_space_size',
//    [ 'groupOptions' => ['class' => ' m6 input-field col s12']]);
?>

<?php echo $form->maskField($realtyDetailed,'living_space_size',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php echo $form->dropDownListGroup($realtyDetailed, 'space_size_units', RealtyDetailedDescription::model()->getSpaseSizeUnits(), array('class'=>'required', 'prompt' => 'Select space size unit')); ?>

<?php
//echo $form->textFieldGroup($realtyDetailed, 'total_space_size');
?>

<?php echo $form->maskField($realtyDetailed,'total_space_size',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php echo $form->maskField($realtyDetailed,'bedrooms',[ 'groupOptions' => ['class' => ' m6 input-field col s12']],"[9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}] [9{1,3}]",
    '
                            greedy : false,
                            radixPoint: " ",
                            numericInput: true,
                            removeMaskOnSubmit: true,
                            autoUnmask: true,
                            '
)?>

<?php
//echo $form->textFieldGroup($realtyDetailed, 'number_of_floors');
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

<?php echo $form->dropDownListGroup($realtyDetailed, 'space_conditions', RealtyDetailedDescription::model()->getSpaseConditions(), array('class'=>'required', 'prompt' => 'Select space size unit')); ?>

<script type="text/javascript">
    $().ready(function () {
        var settings = $('#blog-article-form').data('settings');
        var new_settings = '<?php echo json_encode(array_values($form->attributes)); ?>';

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