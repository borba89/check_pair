<div class="row">
    <div class="col s12">
        <div class="page-title">Carousel</div>
    </div>
    <div class="col s6">
        <div class="card ">
            <div class="card-content">
                <span class="card-title">Example</span>
                <div class="carousel carousel-slider center" data-indicators="true">
                    <?php foreach ($images as $image) { ?>
                    <div style="background: url('<?php echo YHelper::getImagePath($image->path, 482, 400); ?>')" class="carousel-item red white-text" href="#image<?php echo $image->id; ?>">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>