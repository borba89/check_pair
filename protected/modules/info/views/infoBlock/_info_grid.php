<a href="<?php echo Yii::app()->createUrl('/info/infoBlock/view', array('id' => $data->id)); ?>">
    <div class="col s2">
        <div class="card white">
            <div class="card-content center">
                <?php echo $data->title; ?>
            </div>
        </div>
    </div>
</a>