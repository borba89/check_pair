<?php
Yii::app()->clientScript->registerScript('button-label', '
                        var buttonLabel = "Сохранить"
                    ', CClientScript::POS_HEAD);

$this->title = Yii::t('BackendModule.backend', 'Управление пунктами меню');
$this->menu = array(
    array('label' => Yii::t('BackendModule.backend','Управление меню'), 'url' => array('/backend/menu')),
    array('label' => Yii::t('BackendModule.backend','Содать меню'), 'url' => array('/backend/menu/create')),
    array('label' => Yii::t('BackendModule.backend','Содать элемент меню'), 'url' => array('/backend/item/create/', 'id'=>$id)),
);
?>


<?php //Yii::app()->clientScript->registerScriptFile($this->module->assetsDirectory . "/libs/json/json2.min.js"); ?>

<?php
$this->widget('backend.components.ItemList', array('items' => $items, 'activeId' => $activeId));
?>

<script type="text/javascript">
    $('ol.sortable').nestedSortable({
        handle: 'div',
        helper:	'clone',
        opacity: .5,
        revert: 250,
        tolerance: 'pointer',
        toleranceElement: '> div',
        disableNesting: 'no-nest',
        forcePlaceholderSize: true,
        items: 'li',
        placeholder: 'placeholder',
        update: function () {
            list = $(this).nestedSortable('toArray', {startDepthCount: 0});
            $.post('<?php echo $this->createUrl('/' . $this->module->id . '/ajax/save') ?>',
            {list: list },
            function(data){
                $("#result").hide().html(data).fadeIn('slow')
            },
            "html"
        );
        }
    });
</script>