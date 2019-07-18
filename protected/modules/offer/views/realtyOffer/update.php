<?php
    $this->breadcrumbs=array(
        'Realty Offers'=>array('admin'),
        $model->title_ru => array('view','id'=>$model->id),
        'Update',
    );
    $this->title = "Правка: ".$model->title_ru;
?>

<?php echo $this->renderPartial('wizard', array(
    'model'=>$model,
    'realty' => $realty,
    'videos'=>$videos,
    'existVideos'=>$existVideos,
)); ?>