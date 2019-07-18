<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 26.02.19
 * Time: 15:31
 */
?>
<span class="hero-nice-select purposeLand">
    <select name="purposeLand" id="purposeLand">
        <option value=""><?php echo Yii::t('MainModule.main', 'Назначение земли');?></option>
        <?php foreach ($data as $k=>$v):?>
            <option value="<?php echo $k;?>"><?php echo $v;?></option>
        <?php endforeach;?>
    </select>
</span>
