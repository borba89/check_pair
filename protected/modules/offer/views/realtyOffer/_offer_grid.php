<a href="<?php echo Yii::app()->createUrl('/offer/realtyOffer/view', array('id' => $data->id)); ?>">
    <div class="col s2">
        <div class="card white">
            <div class="card-content center">
                <?php
                    echo $data->title_ru . "<br>";
                    echo Yii::t("base", "Просмотры") . "-" . $data->views . "<br>";
                    echo RealtyOffer::model()->getType($data->type) . "<br>";
                    echo $data->ammount . " " . $data->currency;
                    echo $data->type == RealtyOffer::RENT ? ' ' . Yii::t("base", "в месяц") : '';
                ?>
            </div>
        </div>
    </div>
</a>