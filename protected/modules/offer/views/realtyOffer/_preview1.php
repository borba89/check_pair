<?php
    $images = MultipleImages::model()->findAll('item_id = :id', array(':id' => $temp_id));
    if ($images) {
        foreach ($images as $image) {
            echo '<img src="/' . $image->path . '" alt="Your Image" />';
        }
    }
?>

<div class="card-content">
    <?php $realty = Realty::model()->findByPk($item_id); ?>

    Тип недвижимости: <?php echo Realty::model()->getRealtyType($realty->type); ?><br>
    Страна: <?php echo RealtyAddress::model()->getCountries($realty->addressTable->country); ?><br>
    Город: <?php echo RealtyAddress::model()->getCities($realty->addressTable->city); ?><br>
    Район: <?php echo RealtyAddress::model()->getDistrict($realty->addressTable->city_district); ?><br>
    Улица: <?php echo $street; ?><br>
</div>
<div class="card-content">
    Название на русском:
    <?php echo $title_ru; ?><br>
    Название на молдавском:
    <?php echo $title_ro; ?><br>
    Название на английском:
    <?php echo $title_en; ?><br>
    Описание на русском:
    <?php echo $description_ru; ?><br>
    Описание на молдавском:
    <?php echo $description_ro; ?><br>
    Описание на английском:
    <?php echo $description_en; ?><br>
</div>
<div class="card-content">
    Тип объявления:
    <?php echo RealtyOffer::model()->getType($type); ?><br>
    Цена:
    <?php echo $ammount; ?><br>
    Валюта:
    <?php echo RealtyOffer::model()->getType($currency); ?><br>
</div>
<div class="card-content">
    Контент:<br>
    <?php echo $description; ?>
</div>