<?php
/**
 * @var $model Entity
 * @var $attribute string
 * @var $htmlOptions array
 */
?>

<div class="form-group <?php if(CHtml::error($model, $attribute)!="") echo "has-error"; ?>">
    <?php echo CHtml::activeLabelEx($model, $attribute, array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-md-6">
        <?php $this->widget(
            'booster.widgets.TbSelect2',
            array(
                'model' => $model,
                'attribute' => $attribute,
                'data' => $select_options,
                'options' => $options,
                'htmlOptions' => $htmlOptions,
            )
        );
        ?>
    </div>
</div>