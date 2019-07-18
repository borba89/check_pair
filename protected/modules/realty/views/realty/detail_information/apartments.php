<?php $form = new ActiveForm();
$form->id = 'blog-article-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
);
$form->type = 'horizontal';
?>

<?php echo $form->textFieldGroup($realtyDetailed, 'project_type'); ?>

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

<?php echo $form->textFieldGroup($realtyDetailed, 'total_space_size'); ?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'space_size_units',
    RealtyDetailedDescription::model()->getSpaseSizeUnits(),
    array('class'=>'required', 'prompt' => 'Select space size unit'));
?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'floor',
    array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 =>10),
    array('class'=>'required')
); ?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'rooms',
    array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10),
    array('class'=>'required')
); ?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'space_conditions',
    RealtyDetailedDescription::model()->getSpaseConditions(),
    array('class'=>'required', 'prompt' => 'Select space size unit')
); ?>

<?php echo $form->dropDownListGroup(
    $realtyDetailed,
    'num_balcony',
    array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 =>10),
    array('class'=>'required')
); ?>

<?php echo $form->checkboxGroup($realtyDetailed, 'newly_built',
    array('widgetOptions' =>
        array(
            'htmlOptions' => array(
                'checked'=>$realtyDetailed->newly_built ? true : $realtyDetailed->newly_built
            ),
        ),
        'labelOptions' => array(
            'for' =>  CHtml::activeId($realtyDetailed, 'newly_built'),
        )
    )
); ?>

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