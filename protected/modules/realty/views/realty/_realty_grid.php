<a href="<?php echo Yii::app()->createUrl('/realty/realty/view', array('id' => $data->id)); ?>">
    <div class="col s2">
        <div class="card white">
            <div class="card-content center">
                <?php if ($data->type){
                    $dataType = $data->type;
                }else{
                    $dataType = Realty::COMMERTIAL;
                };?>
                <?php echo @$data->getRealtyType(@$dataType); ?>
                <br>
                <?php echo @$data->addressTable->street; ?>
                <br>
                <?php echo @$data->created; ?>
            </div>
        </div>
    </div>
</a>