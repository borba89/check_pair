<a href="<?php echo Yii::app()->createUrl('/realty/realty/view', array('id' => $data->id)); ?>">
    <div class="col s2">
        <div class="card white">
            <div class="card-content center">
                <?php echo $data->realty->getRealtyType($data->type); ?>
                <br>
                <?php echo $data->realty->addressTable->street; ?>
                <br>
                <?php echo $data->ammount; ?>
            </div>
        </div>
    </div>
</a>