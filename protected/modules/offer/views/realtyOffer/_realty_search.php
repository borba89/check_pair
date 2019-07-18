<div class="row search-tabs-header">
    <?php echo $form->textFieldGroup($model, 'searchAddress', array(
        'widgetOptions' => array(
            'htmlOptions' => array(
                'maxlength' => 255,
                'autocomplete' => 'off',
            ),
        ),
        'groupOptions' => array(
            'class' => 'm6 top-filter input-field col s12',
        )
    )); ?>

    <?php echo $form->dropDownListGroup($model, 'type',
        array('' => 'Любая недвижимость') + Realty::model()->getRealtyType(),
        array(
            'groupOptions' => array(
                'class' => 'm6 top-filter dropdown-filter',
            ),
        )
    ); ?>
</div>

<?php Yii::app()->clientScript->registerScript('autocomplete', "
    ajaxAutoComplete({inputId:'Realty_searchAddress',ajaxUrl:'".Yii::app()->createUrl('realty/realty/suggest')."'})
", CClientScript::POS_LOAD); ?>