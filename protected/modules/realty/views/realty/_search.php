<div class="row search-tabs-header">
<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'type'=>'horizontal',
    'method'=>'get',
)); ?>
    <?php echo $form->textFieldGroup($model, 'searchAddress', array(
        'widgetOptions' => array(
            'htmlOptions' => array(
                'maxlength' => 255,
                'autocomplete' => 'off',
            ),
        ),
        'groupOptions' => array(
            'class' => 'm3 top-filter input-field col s12',
        )
    )); ?>

    <?php echo $form->dropDownListGroup($model, 'objects',
        array(
            '0' => 'Все объекты',
            '1' =>'Объекты без объявлений',
        ),
        array(
            'groupOptions' => array(
                'class' => 'm3 top-filter dropdown-filter',
            )
        )
    ); ?>

    <?php echo $form->dropDownListGroup($model, 'status',
        array(
            Realty::OPENED => 'Актуальные объекты',
            Realty::CLOSED => 'Архив объектов недвижимости',
        ),
        array(
            'groupOptions' => array(
                'class' => 'm3 top-filter dropdown-filter',
            )
        )
    ); ?>

    <?php echo $form->dropDownListGroup($model, 'type',
        array('' => 'Любая недвижимость') + Realty::model()->getRealtyType(),
        array(
            'groupOptions' => array(
                'class' => 'm3 top-filter dropdown-filter',
            ),
        )
    ); ?>
<?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->registerScript('autocomplete', "
    ajaxAutoComplete({inputId:'Realty_searchAddress',ajaxUrl:'".Yii::app()->createUrl('realty/realty/suggest')."'})
", CClientScript::POS_LOAD); ?>