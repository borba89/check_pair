<?php
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
                        var buttonLabel = \'' . $label . '\'
                    ', CClientScript::POS_HEAD);

$this->title =  Yii::t('BackendModule.backend', 'Управление меню');
$this->breadcrumbs = array(
    Yii::t('BackendModule.backend', 'Меню'),
);
$this->menu = array(
    array('label' => Yii::t('BackendModule.backend','Создать новое меню'), 'url' => array('/backend/menu/create')),
);
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'code_dialog',
    'options' => array(
        'title' => 'Скопируйте следующий код в соответствующее место в вашем представлении или файле макета:',
        'autoOpen' => false,
        'width' => 800
    ),
));
echo "
    &lt;?php \$this-&gt;widget('MenuRenderer', array('name'=&gt;<span id=\"menu_id\">1</span>)); ?&gt;";
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>


<?php
if (count($model->search()->data)) {
    $this->widget('booster.widgets.TbGridView', array(
        'id' => 'menu-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'id',
            'name',
            array(
                'class' => 'JToggleColumn',
                'name' => 'enabled',
                'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
                'model' => get_class($model),
                'htmlOptions' => array('style' => 'text-align:center;min-width:60px;')
            ),
            'theme',
            array(
                'name' => 'description',
                'htmlOptions' => array('style' => 'text-align:center;min-width:200px;')
            ),
            /*array(
                'class' => 'CButtonColumn',
                'template' => '{update} | {delete}',
                'updateButtonLabel' => 'Menu Settings',
                'deleteButtonLabel' => 'Delete Menu',
                'updateButtonImageUrl' => false,
                'deleteButtonImageUrl' => false,
                'htmlOptions' => array('style' => 'text-align:center;min-width:160px;')
            ),
            array(
                'type' => 'html',
                'value' => 'CHtml::link(Yii::t("BackendModule.backend","Edit Menu Items"),"' . $this->createUrl('/backend/item') . '?id=". ' . '$data->id)',
                'htmlOptions' => array('style' => 'min-width:100px;')
            ),*/
            array(
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::link("Код виджета", "#", array("onclick" => "$(\"#code_dialog\").dialog(\"open\"); $(\"#menu_id\").html(\"\'$data->name\'\"); console.log($data->name); return false;")))',
                'htmlOptions' => array('style' => 'min-width:100px;')
            ),
            array(
                'class' => 'backend.components.ButtonColumn',
                'htmlOptions' => array('width' => '120px'),
                'template'=>'{edit} {update} {delete}',
                'buttons' => array(
                    'update' => array(
                        'label'=>'Menu Settings',     // text label of the button
                    ),
                    'delete' => array(
                        'label'=>'Delete Menu',     // text label of the button
                    ),
                    'edit' => array(
                        'icon'=>'playlist_add',
                        'label'=>Yii::t("BackendModule.backend","Редактировать пункты меню"),     // text label of the button
                        'url'=>'Yii::app()->createUrl("/backend/item/index", array("id"=>$data->id))',       // a PHP expression for generating the URL of the button
                    )
                ),
            ),
        ),
    ));
} else {
    echo Yii::t('app', 'No results found!');
}