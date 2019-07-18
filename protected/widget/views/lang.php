<div class="language">
    <?php if(Yii::app()->language == 'ru') {
        echo CHtml::link('RU', '#', array('class' => 'dropdown-button', 'data-activates' => 'dropdown1'));
    } elseif(Yii::app()->language == 'ro') {
        echo CHtml::link('RO', '#', array('class' => 'dropdown-button', 'data-activates' => 'dropdown1'));
    } elseif(Yii::app()->language == 'en') {
        echo CHtml::link('EN', '#', array('class' => 'dropdown-button', 'data-activates' => 'dropdown1'));
    } ?>

    <ul id='dropdown1' class='dropdown-content'>
        <li><?php echo CHtml::link('RU', Yii::app()->createUrl('main/default/change', array('lang' => 'ru'))); ?></li>
        <li><?php echo CHtml::link('RO', Yii::app()->createUrl('main/default/change', array('lang' => 'ro'))); ?></li>
        <li><?php echo CHtml::link('EN', Yii::app()->createUrl('main/default/change', array('lang' => 'en'))); ?></li>
    </ul>
</div>
