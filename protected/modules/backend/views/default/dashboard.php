<?php
$label = 'Tmp Label!!!';
    $this->breadcrumbs=array(
        'Dashboard'
    );
    Yii::app()->clientScript->registerScript('button-label', '
        var buttonLabel = \'' . $label . '\'
    ', CClientScript::POS_HEAD);
    $this->title = "Dashboard";
?>

<?php $this->renderStatistic(); ?>