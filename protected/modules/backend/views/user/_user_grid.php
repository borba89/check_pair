<a href="<?php echo Yii::app()->createUrl('/backend/user/view', array('id' => $data->id)); ?>">
    <div class="col s3">
        <!--<div class="card white">
            <div class="card-content center">
                <?php /*echo $data->getAllRoles($data->role); */?>
                <br>
                <?php /*echo $data->email; */?>
                <br>
                <?php /*echo $data->fullName; */?>
            </div>
        </div>-->

        <div class="card">
            <div class="card-content center-align">
                <img src="<?php echo $data->getAvatarSrc();?>" class="circle" alt="" width="128" height="128">
                <p class="m-t-sm"><?php echo $data->fullName; ?></p>
                <div class="m-t-sm"><?php echo $data->getAllRoles($data->role); ?></div>
                <div class="m-t-xs light" style="font-size: 11px;"><?php echo $data->email; ?></div>
            </div>
        </div>
    </div>
</a>