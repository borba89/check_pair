<a href="<?php echo Yii::app()->createUrl('/blog/blogArticle/view', array('id' => $data->id)); ?>">
    <div class="col s2">
        <div class="card white">
            <div class="card-content center">
                <?php echo $data->title; ?>
                <br>
                <?php echo $data->created; ?>
            </div>
        </div>
    </div>
</a>