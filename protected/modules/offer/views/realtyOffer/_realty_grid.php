<?php
    $class = '';
    if (!$realty->isNewRecord) {
        $class = ($realty->realty_id == $data->id) ? 'selected' : '';
    }
?>
<div class="col s2 realty-item <?php echo $class; ?>" data-id="<?php echo $data->id; ?>">
    <div class="card white">
        <div class="card-content center">
            <?php echo $data->getRealtyType($data->type); ?>
            <br>
            <?php echo $data->addressTable->street; ?>
            <br>
            <?php echo $data->created; ?>
        </div>
    </div>
</div>