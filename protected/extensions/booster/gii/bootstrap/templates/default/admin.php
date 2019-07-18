<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
    echo "\t\$this->breadcrumbs=array(
        '$label'=>array('admin'),
        'Manage',
    );\n";
?>

    $this->menu=array(
        array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
    );
    $this->title = "Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?>";
?>

<?php echo "<?php"; ?> $this->widget('booster.widgets.TbGridView',array(
    'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
    'type' => 'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++$count == 7) {
		echo "\t\t/*\n";
	}
	echo "\t\t'" . $column->name . "',\n";
}
if ($count >= 7) {
	echo "\t\t*/\n";
}
?>
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '70px'),
        ),
    ),
)); ?>
