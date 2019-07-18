<?php
class SidePager extends LinkPager
{
    public $previousPageCssClass = 'arrow-left';
    public $nextPageCssClass = 'arrow-right';
    public $prevPageLabel = '';
    public $nextPageLabel = '';

    public function run()
    {
        $this->firstPageLabel = Yii::t("MainModule.main", 'В начало');
        $this->lastPageLabel = Yii::t("MainModule.main", 'В конец');

        $this->registerClientScript();
        $buttons=$this->createPageButtons();
        if (empty($buttons)) {
            return;
        }

        echo '<div class="side-links">';

        echo implode("\n",$buttons);

        echo '</div>';
    }

    protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
        $link = CHtml::link($label,$this->createPageUrl($page),array('class' => $class));
        return $link;
    }

    protected function createPageButtons()
    {
        if(($pageCount=$this->getPageCount())<=1)
            return array();

        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();

        // prev page
        if(($page=$currentPage-1)<0)
            $page=0;
        $buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);

        // next page
        if(($page=$currentPage+1)>=$pageCount-1)
            $page=$pageCount-1;
        $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

        return $buttons;
    }
}