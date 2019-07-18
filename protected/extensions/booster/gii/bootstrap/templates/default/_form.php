<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('class' =>'form-horizontal row-border'),
)); ?>\n"; ?>

    <?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach ($this->tableSchema->columns as $column) {
	if ($column->autoIncrement) {
		continue;
	}
	?>
	<?php echo "<?php echo " . $this->generateActiveGroup($this->modelClass, $column) . "; ?>\n"; ?>

<?php
}
?>

    <?php echo "<?php \$this->widget('booster.widgets.TbButton', array(
        'buttonType'=>'formSubmit',
        'htmlOptions' => array('class' => 'btn btn-primary'),
        'label'=>\$model->isNewRecord ? 'Create' : 'Save',
    )); ?>\n"; ?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
