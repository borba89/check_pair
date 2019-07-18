<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 16.01.19
 * Time: 15:11
 */
Yii::import('zii.widgets.CMenu');
class CmMenu extends CMenu
{
    /**
     * Renders the menu items.
     * @param array $items menu items. Each menu item will be an array with at least two elements: 'label' and 'active'.
     * It may have three other optional elements: 'items', 'linkOptions' and 'itemOptions'.
     */
    protected function renderMenu($items)
    {
        if(count($items))
        {
            echo CHtml::openTag('ul',$this->htmlOptions)."\n";
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('ul');
        }
    }

    /**
     * Recursively renders the menu items.
     * @param array $items the menu items to be rendered recursively
     */
    protected function renderMenuRecursive($items)
    {
        $count=0;
        $n=count($items);
        foreach($items as $item)
        {
            $count++;
            $options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class=array();
            if($item['active'] && $this->activeCssClass!='')
                $class[]=$this->activeCssClass;
            if($count===1 && $this->firstItemCssClass!==null)
                $class[]=$this->firstItemCssClass;
            if($count===$n && $this->lastItemCssClass!==null)
                $class[]=$this->lastItemCssClass;
            if($this->itemCssClass!==null)
                $class[]=$this->itemCssClass;
            if($class!==array())
            {
                if(empty($options['class']))
                    $options['class']=implode(' ',$class);
                else
                    $options['class'].=' '.implode(' ',$class);
            }

            echo CHtml::openTag('li', $options);

            $menu=$this->renderMenuItem($item);
            if(isset($this->itemTemplate) || isset($item['template']))
            {
                $template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template,array('{menu}'=>$menu));
            }
            else
                echo $menu;

            if(isset($item['items']) && count($item['items']))
            {
                echo "<div class='collapsible-body'>\n";
                echo "\n".CHtml::openTag('ul',isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions)."\n";
                $this->renderMenuRecursive($item['items']);
                echo CHtml::closeTag('ul')."\n";
                echo "</div>\n";
            }

            echo CHtml::closeTag('li')."\n";
        }
    }

    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please see {@link items} on what data might be in the item.
     * @return string
     * @since 1.1.6
     */
    protected function renderMenuItem($item)
    {
        if (isset($item['icon'])) {
            if (strpos($item['icon'], 'icon') === false && strpos($item['icon'], 'fa') === false) {
                $item['label'] = "<i class='material-icons'>".$item['icon']."</i>\r\n<span>" . $item['label'] . '</span>';
            } else {
                $item['label'] = "<i class='material-icons'>".$item['icon']."</i>\r\n<span>" . $item['label'] . '</span>';
            }
        }

        $item['linkOptions']['class'] = 'collapsible-header waves-effect waves-grey';

        if (isset($item['items']) && !empty($item['items'])) {
            if (empty($item['url'])) {
                $item['url'] = '#';
            }

            if (isset($item['linkOptions']['class'])) {
                $item['linkOptions']['class'] .= ' dropdown-toggle';
            } else {
                $item['linkOptions']['class'] = 'dropdown-toggle';
            }

            $item['linkOptions']['data-toggle'] = 'dropdown';
            $item['label'] .= ' <i class="nav-drop-icon material-icons">keyboard_arrow_right</i>';
        }

        if(isset($item['url'])) {
            $label=$this->linkLabelWrapper===null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
            return CHtml::link($label,$item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
        }
        else{
            $label=$this->linkLabelWrapper===null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
            return CHtml::link($label,'#',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
        }

    }
}