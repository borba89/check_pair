<?php
    $images = MultipleImages::model()->findAll('item_id = :id', array(':id' => $temp_id));
?>

<div class="slider">
    <ul class="slides">
        <?php if ($images) { ?>
            <?php foreach ($images as $i => $image) { ?>
                <li>
                    <img src="/<?php echo $image->path ?>"> <!-- random image -->
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>

<div class="card-content">
    Тип недвижимости: <?php echo Realty::model()->getRealtyType($type); ?><br>
    Страна: <?php echo RealtyAddress::model()->getCountries($country); ?><br>
    Город: <?php echo RealtyAddress::model()->getCities($city); ?><br>
    Район: <?php echo RealtyAddress::model()->getDistrict($city_district); ?><br>
    Улица: <?php echo $street; ?><br>
</div>
<div class="card-content">
    <?php if (isset($parcel_size)) { ?>
        Значение площади земельного участка:
        <?php echo $parcel_size; ?><br>
    <?php } ?>
    <?php if (isset($total_space_size)) { ?>
        Общая площадь помещений:
        <?php echo $total_space_size; ?><br>
    <?php } ?>
    <?php if (isset($space_size_units)) { ?>
        Единицы измерения площади помещений:
        <?php echo RealtyDetailedDescription::model()->getSpaseSizeUnits($space_size_units); ?><br>
    <?php } ?>
    <?php if (isset($number_of_floors)) { ?>
        Этаж, где расположена квартира:
        <?php echo $number_of_floors; ?><br>
    <?php } ?>
    <?php if (isset($rooms)) { ?>
        Количество комнат:
        <?php echo $rooms; ?><br>
    <?php } ?>
    <?php if (isset($space_conditions)) { ?>
        Состояние помещений:
        <?php echo RealtyDetailedDescription::model()->getSpaseConditions($space_conditions); ?><br>
    <?php } ?>
    <?php if (isset($newly_built)) { ?>
        Является ли объект недвижимости новостроем:
        <?php echo $newly_built ? 'Да' : 'Нет'; ?><br>
    <?php } ?>
</div>
<div class="card-content">
    Контент:<br>
    <?php echo $description; ?>
</div>