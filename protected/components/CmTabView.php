<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 22.01.19
 * Time: 16:52
 */

class CmTabView extends CTabView
{
    protected function renderHeader()
    {
        echo "<ul class=\"tabs tab-demo z-depth-1\">\n";
        foreach($this->tabs as $id=>$tab)
        {
            $title=isset($tab['title'])?$tab['title']:'undefined';
            $active=$id===$this->activeTab?' class="active"' : '';
            $url=isset($tab['url'])?$tab['url']:"#{$id}";
            echo "<li class='tab col'><a href=\"{$url}\"{$active}>{$title}</a></li>\n";
        }
        echo "</ul>\n";
    }

    /**
     * Registers the needed CSS and JavaScript.
     */
    public function registerClientScript()
    {
        $cs=Yii::app()->getClientScript();
        $id=$this->getId();

        if($this->cssFile!==false)
            self::registerCssFile($this->cssFile);
    }
}