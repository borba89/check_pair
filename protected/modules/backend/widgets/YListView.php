<?php
Yii::import('zii.widgets.CListView');

class YListView extends CListView
{
    /**
     * Renders the sorter.
     */
    public function renderSorter()
    {
        if ($this->dataProvider->getItemCount()<=0 || !$this->enableSorting || empty($this->sortableAttributes))
            return;
        echo CHtml::openTag('div',array('class'=>$this->sorterCssClass))."\n";
        echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
        echo "<ul>\n";
        $sort=$this->dataProvider->getSort();
        foreach ($this->sortableAttributes as $name=>$label)
        {
            echo "<li>";
            if(is_integer($name))
                echo $sort->link($label);
            else
                echo $sort->link($name,$label);
            echo "</li>\n";
        }
        echo "</ul>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
    }
}