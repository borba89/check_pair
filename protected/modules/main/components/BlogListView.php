<?php
Yii::import('zii.widgets.CListView');

class BlogListView extends CListView
{
    public $sidePager;

    private static $dateChange = 0;

    public function run()
    {
        $this->registerClientScript();

        echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";

        $this->renderContent();
        $this->renderKeys();

        echo CHtml::closeTag($this->tagName);
    }

    /**
     * Renders the sorter.
     */
    public function renderSorter()
    {
        if($this->dataProvider->getItemCount()<=0 || !$this->enableSorting || empty($this->sortableAttributes))
            return;
        echo CHtml::openTag('div',array('class'=>$this->sorterCssClass))."\n";
        echo CHtml::openTag('div',array('class'=>'flex flex-start-sm'))."\n";
        echo CHtml::openTag('div',array('class'=>'mb-1em-xs text-center-xs'))."\n";
        $sort=$this->dataProvider->getSort();
        foreach($this->sortableAttributes as $name=>$label)
        {
            if (is_integer($name)) {
                echo $sort->link($label, null, array('class' => 'button-medium button-green br-radius-0 f-light width-11em mb-0_5em-xs pr-0_5em')).' ';
            } else {
                echo $sort->link($name, $label, array('class' => 'button-medium button-green br-radius-0 f-light width-11em mb-0_5em-xs pr-0_5em'));
            }
        }
        echo "</ul>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
        echo CHtml::closeTag('div');
        echo CHtml::closeTag('div');
    }

    /**
     * Renders the pager.
     */
    public function renderPager()
    {
        if(!$this->enablePagination)
            return;

        $pager=array();
        $class='CLinkPager';
        if (is_string($this->pager))
            $class=$this->pager;
        elseif (is_array($this->pager))
        {
            $pager=$this->pager;
            if (isset($pager['class']))
            {
                $class=$pager['class'];
                unset($pager['class']);
            }
        }
        $pager['pages']=$this->dataProvider->getPagination();

        if($pager['pages']->getPageCount()>1)
        {
            echo '<div class="'.$this->pagerCssClass.'">';
            if ($this->sidePager) {
                $this->renderSorter();
            }
            $this->widget($class,$pager);
            echo '</div>';
        }
        else
            $this->widget($class,$pager);
    }

    public function renderItems()
    {
        $data=$this->dataProvider->getData();
        if(($n=count($data))>0)
        {
            $owner=$this->getOwner();
            $viewFile=$owner->getViewFile($this->itemView);
            $j=0;
            foreach($data as $i=>$item)
            {
                $data=$this->viewData;
                $data['index']=$i;
                $data['data']=$item;
                $data['widget']=$this;

                /*if (self::$dateChange != $item->updated) {
                    echo CHtml::openTag('div',
                        array('class' => 'pt-0_5em mb-2em flex items-center up br-bottom br-1 br-grey'));
                    echo CHtml::tag('div', array('class' => 'h5 pr-0_5em c-green'), YHelper::formatDate('yyyy,', $item->updated, 'yyyy-MM-dd'));
                    echo CHtml::tag('div', array('class' => 'h5 c-green'), YHelper::formatDate('dd MMMM', $item->updated, 'yyyy-MM-dd'));
                    echo CHtml::closeTag('div');
                    self::$dateChange = $item->updated;
                }*/

                $owner->renderFile($viewFile,$data);
                if($j++ < $n-1)
                    echo $this->separator;
            }
        }
        else
            $this->renderEmptyText();
    }
}