<?php
class LinkPager extends CLinkPager
{
    public $previousPageCssClass = '';
    public $prevPageLabel = '<';
    public $nextPageLabel = '>';
    public $nextPageCssClass = '';
    public $selectedPageCssClass = 'active';
    public $internalPageCssClass = '';
    public $firstPageLabel = '';
    public $lastPageLabel = '';
    public $firstPageCssClass = 'button-medium button-green br-radius-0';
    public $lastPageCssClass = 'button-medium button-green br-radius-0';
    public $hiddenPageCssClass = 'disabled';
    public $firstWrapperCssClass = 'col-xs-12 col-sm-12 col-md-6 mt-2em-xs mt-2em-sm';
    public $secondWrapperCssClass = 'flex flex-end';
    public $cycle = false;

    public function run()
    {
        $this->firstPageLabel = ($this->firstPageLabel)?$this->firstPageLabel:Yii::t("MainModule.main", 'В начало');
        $this->lastPageLabel = ($this->lastPageLabel)?$this->lastPageLabel:Yii::t("MainModule.main", 'В конец');

        $this->registerClientScript();
        $buttons=$this->createPageButtons();
        if (empty($buttons)) {
            return;
        }

        echo '<div class="'.$this->firstWrapperCssClass.'">';
            echo '<div class="'.$this->secondWrapperCssClass.'">';
                echo '<ul class="pagination">';
                    echo implode("\n",$buttons);
                echo '</ul>';
            echo '</div>';
        echo '</div>';
    }

    protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
        $classActivity = '';
        if($hidden || $selected)
            $classActivity = ($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);

        $link = CHtml::link($label,$this->createPageUrl($page),array('class' => $class));
        return Chtml::tag('li', array('class' => $classActivity), $link);
    }

    protected function createPageButtons()
    {
        if(($pageCount=$this->getPageCount())<=1)
            return array();

        list($beginPage,$endPage)=$this->getPageRange();
        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();

        // first page
        if ($this->firstPageLabel !== false) {
            $buttons[]=$this->createPageButton($this->firstPageLabel,0,$this->firstPageCssClass,$currentPage<=0,false);
        }

        // prev page
        if(($page=$currentPage-1)<0){
            if ($this->cycle){
                $page=$pageCount-1;
            } else {
            $page=0;
            }
        }

        $buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);

        // internal pages
        for($i=$beginPage;$i<=$endPage;++$i)
            $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

        // next page
        if(($page=$currentPage+1)>=$pageCount-1){
                $page=$pageCount-1;
        }
        if((($page=$currentPage+1)>=$pageCount) && ($this->cycle)){
                $page=0;
            }

        $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

        // last page
        if ($this->lastPageLabel !== false) {
            $buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,$this->lastPageCssClass,$currentPage>=$pageCount-1,false);
        }

        return $buttons;
    }
}