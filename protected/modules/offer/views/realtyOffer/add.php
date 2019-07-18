<?php
$form = new CActiveForm();
$form->id = 'blog-article-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
    'inputContainer' => 'fieldset',
); ?>

<li id="area" class="collection-item">
    <?php echo CHtml::link(Yii::t("OfferModule.offer", 'Убрать'), '#', array(
        'class' => 'secondary-content delete'
    )); ?>
    <?php echo $form->textField($parameter, "[$count]parameter"); ?>
    <?php echo $form->error($parameter, "[$count]parameter"); ?>

    <script type="text/javascript">
        $().ready(function () {
            var settings = $("#blog-article-form").data('settings');
            var new_settings = '<?php echo json_encode(array_values($form->attributes)); ?>';

            if (new_settings != "") {
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
                $("#blog-article-form").data('settings', settings);
            }

        });
    </script>
</li>