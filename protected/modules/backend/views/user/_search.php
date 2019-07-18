<div class="row search-tabs-header">
    <?php $form=$this->beginWidget('backend.components.ActiveForm',array(
        'action'=>Yii::app()->createUrl($this->route),
        'type'=>'horizontal',
        'method'=>'get',
    )); ?>

    <?php echo $form->textFieldGroup($model, 'searchString', array(
        'widgetOptions' => array(
            'htmlOptions' => array(
                'maxlength' => 255,
                'autocomplete' => 'off',
            ),
        ),
        'groupOptions' => array(
            'class' => 'm4 top-filter input-field col s12',
        )
    )); ?>

    <?php echo $form->dropDownListGroup($model, 'is_active',
        array(
            User::ACTIVE => 'Active',
            User::INACTIVE => 'Inactive'
        ),
        array(
            'groupOptions' => array(
                'class' => 'm4 top-filter dropdown-filter',
            )
        )
    ); ?>

    <?php echo $form->dropDownListGroup($model, 'role',
        array('' => 'Все роли') + User::model()->getAllRoles(),
        array(
            'groupOptions' => array(
                'class' => 'm4 top-filter dropdown-filter',
            )
        )
    ); ?>
    <?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->registerScript('autocomplete', "
    ajaxAutoComplete({inputId:'User_searchString',ajaxUrl:'".Yii::app()->createUrl('backend/user/suggest')."'})
", CClientScript::POS_LOAD); ?>