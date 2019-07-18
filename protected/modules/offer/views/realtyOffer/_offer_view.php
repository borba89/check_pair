<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 12.02.19
 * Time: 12:11
 */
/*if(Yii::app()->settings->get(Settings::GENERAL, 'ad_creation')){
    $this->menu=array(
        array('label'=>'Создать объявление','url'=>array('createAd')),
    );
}else{
    $this->menu=array(
        array('label'=>'Создать объявление','url'=>array('create')),
    );
}*/
$updateUrl = 'Yii::app()->createUrl("/offer/realtyOffer/update", array("id"=>$data->id))';
if(Yii::app()->settings->get(Settings::GENERAL, 'ad_creation')){
    $updateUrl = 'Yii::app()->createUrl("/offer/realtyOffer/updateAd", array("id"=>$data->id))';
}
?>

<div style="height: 10px;"></div>
<div class="col s12">
    <div class="right-align">
        <?php if(Yii::app()->settings->get(Settings::GENERAL, 'ad_creation')):?>
            <a class="waves-effect waves-light btn m-b-xs btn-success-custom" href="/offer/realtyOffer/createAd"><?php echo Yii::t('BackendModule.backend', 'Создать объявление');?></a>
        <?php else:?>
            <a class="waves-effect waves-light btn m-b-xs btn-success-custom" href="/offer/realtyOffer/create"><?php echo Yii::t('BackendModule.backend', 'Создать объявление');?></a>
        <?php endif;?>
    </div>
</div>
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'=>'realty-offer-grid',
//    'template' => '{items} {pager}',
    'dataProvider'=>$dataProvider,
    //'filter'=>$model,
//    'ajaxUpdate'=>false,
//    'afterAjaxUpdate'=>'js:function() {}',
    'columns'=>array(
        array(
            'header' => 'Активно',
            'value' => 'CHtml::checkBox("cid[]", $data->is_active, array("value"=>$data->id, "id"=>"cid_".$data->id, "class"=>"offer-toggle"))',//'$data->id',
            'type'=>'raw',
            'htmlOptions' => array('width' => '60px', 'style'=>'text-align:center;'),
            'headerHtmlOptions'=>array(
                'width' => '60px'
            ),
        ),
        array(
            'header' => 'ID',
            'value' => '$data->id',
            'type'=>'raw',
            'htmlOptions' => array('width' => '60px', 'style'=>'text-align:center;'),
            'headerHtmlOptions'=>array(
                'width' => '60px',
                'style'=>'text-align:center;'
            ),
        ),
        
        //'id', - removed in order to customize table
        //'title', - same as above

        array(
            'header' => 'Заголовок объявления',
            'value' => '$data->title',
            'type'=>'raw',
            'htmlOptions' => array('width' => '200px', 'style'=>'text-align:left;'),
            'headerHtmlOptions'=>array(
                'width' => '200px'
            ),
        ),

        array(
            'name'=>'type',
            'value'=>'RealtyOffer::model()->getType($data->type)',
            'htmlOptions' => array('width' => '180px', 'style'=>'text-align:center;'),
            'headerHtmlOptions'=>array(
                'width' => '180px',
                'style'=>'text-align:center;'
            ),
        ),
        array(
            'header'=>Yii::t('OfferModule.offer', 'Цена'),
            'value'=>'$data->ammount . " " . $data->currency .$data->viewBidType()',
            'htmlOptions' => array('width' => '180px', 'style'=>'text-align:center;'),
            'headerHtmlOptions'=>array(
                'width' => '180px',
                'style'=>'text-align:center;'
            ),
        ),
        /*
        'title_en',
        'title_ro',
        'title_ru',
        'content_en',
        'content_ro',
        'content_ru',
        */
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '120px', 'style'=>'min-width: 120px;'),
            'template'=>'{view} {auction} {update} {delete}',
            'buttons' => array(
                'update' => array(
                    'url'=>$updateUrl,       // a PHP expression for generating the URL of the button
                ),
                'view' => array(
                    'url'=>'Yii::app()->createUrl("/main/realty/single", array("id"=>$data->id))',
                    'options' => array('target' => '_new'),
                ),
                'auction' => array(
                    'icon'=>'gavel',
                    'label'=> Yii::t("BackendModule.backend","Аукцион"),     // text label of the button
                    'url'=> '$data->auction ? Yii::app()->createUrl("/backend/auction/view", ["id"=>$data->auction->id]) : Yii::app()->createUrl("/backend/auction/create", ["offer_id"=>$data->id])',
                ),
            ),
        ),
    ),
)); ?>

<?php
$js = <<<JS
    $(document).on('change', '.offer-toggle', function () {
        var id = $(this).val();
        $.post('/offer/realtyOffer/lotToggle/id/'+id, function(data) {
            console.log(data);  
        });
    });  
JS;
Yii::app()->clientScript->registerScript('check-offer-handle', $js, CClientScript::POS_END);
?>