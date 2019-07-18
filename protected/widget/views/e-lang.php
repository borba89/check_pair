<div class="languages">
    <select>
        <option value="1" <?php echo (Yii::app()->language == 'en')?'selected':''?> data-url="<?php echo Yii::app()->createUrl('main/default/change', array('lang' => 'en')); ?>">EN</option>
        <option value="2" <?php echo (Yii::app()->language == 'ru')?'selected':''?> data-url="<?php echo Yii::app()->createUrl('main/default/change', array('lang' => 'ru')); ?>">RU</option>
        <option value="3" <?php echo (Yii::app()->language == 'ro')?'selected':''?> data-url="<?php echo Yii::app()->createUrl('main/default/change', array('lang' => 'ro')); ?>">MD</option>
    </select>
</div>
