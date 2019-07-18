<div class="row search-tabs-header">
    <?php $form=$this->beginWidget('backend.components.ActiveForm',array(
        'action'=>Yii::app()->createUrl($this->route),
        'type'=>'horizontal',
        'method'=>'get',
    )); ?>

    <?php echo $form->textFieldGroup($model, 'title', array(
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
            BlogArticle::ACTIVE => 'На сайте',
            BlogArticle::INACTIVE => 'Архив'
        ),
        array(
            'groupOptions' => array(
                'class' => 'm4 top-filter dropdown-filter',
            )
        )
    ); ?>

    <?php echo $form->dropDownListGroup($model, 'language',
        array('' => 'Все языки') + BlogArticle::model()->getLanguages(),
        array(
            'groupOptions' => array(
                'class' => 'm4 top-filter dropdown-filter',
            )
        )
    ); ?>
    <?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->registerScript('autocomplete', "
    ajaxAutoComplete({inputId:'BlogArticle_title',ajaxUrl:'".Yii::app()->createUrl('blog/blogArticle/suggest')."'})
", CClientScript::POS_LOAD); ?>