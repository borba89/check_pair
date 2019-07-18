<div class="middle-content">
    <div class="row no-m-t no-m-b">
        <?php foreach($allBlocks as $allBlock) { ?>
        <div class="col s12 m12 l4">
            <div class="card stats-card">
                <div class="card-content">
                    <span class="card-title"><?php echo $allBlock['title']; ?></span>
                    <span class="stats-counter">
                        <span class="counter">
                            <?php echo $allBlock['value']; ?>
                        </span>
                        <small><?php echo $allBlock['descpiption']; ?></small>
                    </span>
                    <!--<div class="percent-info green-text">8% <i class="material-icons">trending_up</i></div>-->
                </div>
                <div class="progress stats-card-progress">
                    <div class="determinate" style="width: 70%"></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>