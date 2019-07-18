<?php
return array(
    'sizer' => array(
        'nested' => false,
        'inSummary' => true,
        'type' => 'striped bordered condensed',
        'template'=>"{sizer}\n{summary}\n{items}\n{pager}",
        'afterAjaxUpdate' => "js:function() {
            var selectedPageSize = $('.change-pageSize').val();
            $('.change-pageSize').select2({'minimumResultsForSearch':'Infinity','width':'resolve'}).select2('val', selectedPageSize);
        }"
    ),
    'nested' => array(
        'enableSizer' => false,
        'nested' => true,
        'rowCssClassExpression'=>'"items[]_{$data->id}"',
        'type' => 'striped bordered condensed',
        'afterAjaxUpdate' => "js:function() {
            sortable_table.init('/backend/".Yii::app()->controller->id."/sort?attribute=ord');
        }"
    ),
);
