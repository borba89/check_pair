<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 12.02.19
 * Time: 12:13
 */
?>
<div style="height: 10px;"></div>
<div class="col s12">
    <div class="right-align">
        <a class="waves-effect waves-light btn m-b-xs" href="/backend/vacancy/create"><?php echo Yii::t('BackendModule.backend', 'Создать вакансию');?></a>
    </div>
</div>

<?php $this->widget('booster.widgets.TbGridView', array(
    'id'=>'vacancy-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        'title_en',
        'title_ro',
        'title_ru',
        //'subtitle_en',
        //'subtitle_ro',
        /*
        'subtitle_ru',
        'text_en',
        'text_ro',
        'text_ru',
        'image',
        */
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '80px'),
            'template'=>'{update} {delete}',
            'buttons'=>array(
                'update' => array(
                    //'label'=>'...',     // text label of the button
                    'url'=>'Yii::app()->createUrl("backend/vacancy/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    //'label'=>'...',     // text label of the button
                    'url'=>'Yii::app()->createUrl("backend/vacancy/delete", array("id"=>$data->id))',
                )
            ),
        ),
    ),
)); ?>
