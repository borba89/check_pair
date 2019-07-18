<?php $form = new ActiveForm();
$form->id = 'blog-article-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
);
$form->type = 'horizontal';
?>

<?php echo $form->dropDownListGroup($realtyDetailed, 'type', RealtyDetailedDescription::model()->getCommercialTypes(), array('class'=>'required', 'prompt' => 'Select type')); ?>

<div style="clear: both"></div>

<?php
//echo $form->textFieldGroup(
//    $realtyDetailed,
//    'total_space_size',
//    [ 'groupOptions' => ['class' => ' m6 input-field col s12']]);
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

<?php echo $form->dropDownListGroup($realtyDetailed, 'space_size_units', RealtyDetailedDescription::model()->getSpaseSizeUnits(), array('class'=>'required', 'prompt' => 'Select space size unit')); ?>

<script type="text/javascript">
    $().ready(function () {
        var settings = $('#blog-article-form').data('settings');
        var new_settings = '<?php echo json_encode(array_values($form->attributes)); ?>';

        if (new_settings != '' && settings) {
            new_settings = eval(new_settings);
            console.log(new_settings);
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