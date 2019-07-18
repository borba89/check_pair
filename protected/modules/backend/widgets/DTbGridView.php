<?php
Yii::import('booster.widgets.TbGridView');

class DTbGridView extends TbGridView
{
    /**
     * @var boolean whether to enable sizer
     * Defaults to true.
     */
    public $enableSizer = true;
    /**
     * @var string GET attribute
     */
    public $sizerAttribute = 'pageSize';
    /**
     * @var array items per page sizes variants
     */
    public $sizerVariants = array(5, 10, 20, 30);
    /**
     * @var string CSS class of sorter element
     */
    public $sizerCssClass = 'wraper-pagesizer';
    /**
     * @var string the text shown before sizer links. Defaults to empty.
     */
    public $sizerHeader = 'Show by: ';
    /**
     * @var string the text shown after sizer links. Defaults to empty.
     */
    public $sizerFooter = ' pages in a row';
    public $inSummary = false;
    public $nested = false;
    public $sortUrl = '';

    public function init()
    {
        if($this->inSummary) {
            $total=$this->dataProvider->getTotalItemCount();
            if($this->summaryText === null)
                $this->summaryText = Yii::t('zii','Displaying {start}-{end} of 1 result.|Displaying {start}-{end} of {count} results.',$total);
        }

        if (!isset($this->sizerVariants[0]))
            $this->sizerVariants = array(10);
        if ($this->enableSizer) {
            $pageSize = Yii::app()->request->getQuery($this->sizerAttribute, $this->sizerVariants[0]);
            $this->dataProvider->getPagination()->setPageSize($pageSize);
        }

        Booster::getBooster()->registerPackage('select2');

        if($this->enableSizer) {
            Yii::app()->clientScript->registerScript('pageSize',"
                var selectedPageSize = $('.change-pageSize').val();
                $('body').on('change', '.change-pageSize', function() {
                    $.fn.yiiGridView.update('".$this->id."',{ data:{ '".$this->sizerAttribute."': $(this).val() }});
                });
                $('.change-pageSize').select2({'minimumResultsForSearch':'Infinity','width':'resolve'}).select2('val', selectedPageSize);
            ");
        }

        /*if($this->filter) {
            Yii::app()->clientScript->registerScript('pageSize1',"
                $('#".ucfirst($this->dataProvider->model->getClass())."_is_active').select2({'minimumResultsForSearch':'Infinity'});
                $('#".ucfirst($this->dataProvider->model->getClass())."_user_id').select2({'minimumResultsForSearch':'Infinity'});
            ");
        }*/

        if($this->nested) {
            if(empty($this->sortUrl))
                $this->sortUrl = '/'.$this->controller->module->id .'/'.Yii::app()->controller->id.'/sort?attribute=ord';

            $this->dataProvider->sort->defaultOrder = 'ord ASC';

            Yii::app()->clientScript->registerScript('nested',"
                var fixHelper = function(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());
                    });
                    return ui;
                };

                var sortable_table = {
                    init: function(url){
                        $('.grid-view table.items tbody').sortable({
                            forcePlaceholderSize: true,
                            forceHelperSize: true,
                            items: 'tr',
                            handle: '.handle-sortable',
                            update : function () {
                                serial = $('.grid-view table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                                $.ajax({
                                    'url': url,
                                    'type': 'post',
                                    'data': serial,
                                    'success': function(data){
                                    },
                                    'error': function(request, status, error){
                                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                                    }
                                });
                            },
                            helper: fixHelper
                        }).disableSelection();
                    }
                }
                sortable_table.init('$this->sortUrl');
            ");
        }

        parent::init();
    }
    public function renderSizer()
    {
        if (!$this->enableSizer)
            return;

        $itemCount = $this->dataProvider->getTotalItemCount();
        if ($itemCount <= 0 || $itemCount < $this->sizerVariants[0])
            return;

        $render = null;
        $pageSize = $this->dataProvider->getPagination()->getPageSize();
        $pageVar = $this->dataProvider->getPagination()->pageVar;

        $render .= CHtml::openTag('div', array('class' => $this->sizerCssClass)) . "\n";
        $render .= $this->sizerHeader;

        $data = array();
        foreach($this->sizerVariants as $count)
        {
            $params = array_replace($_GET, array($this->sizerAttribute => $count));
            if (isset($params[$pageVar]))
                unset($params[$pageVar]);

            $data[$count] = $count;
        }

        $render .= CHtml::dropDownList(
            $this->sizerAttribute,
            $pageSize,
            $data,
            array('class'=>'change-pageSize'));

        $render .= $this->sizerFooter;
        $render .= CHtml::closeTag('div');

        if(preg_match('~{summary}~', $this->template) && $this->inSummary)
            $this->summaryText .= $render;
        else
            echo $render;
    }
}