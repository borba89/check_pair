<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class="row">
    <div class="col-md-12">
        <p class="text-center">
            <span class="text-info" style="font-size:4em;">Error <?php echo $code; ?></span><br />
            <span class="text-info" style="font-size:1em;"><?php echo CHtml::encode($message); ?></span>
        </p>
        <p class="text-center">It looks like you have taken a wrong turn</p>
        <p class="text-center">If you are in denial and think it's a conspiracy that cannot possibly be true,</br>try using the search bar below.</p>
    </div>
</div>