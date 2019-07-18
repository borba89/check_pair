<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 19.01.19
 * Time: 23:05
 */
Yii::import('booster.widgets.TbDropdown');
class CbDropdown extends TbDropdown
{
    public function init() {

        parent::init();

        if (isset($this->htmlOptions['class'])) {
            $this->htmlOptions['class'] .= ' ';
        } else {
            $this->htmlOptions['class'] = '';
        }
    }

    /**
     *### .renderMenuItem()
     *
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     *
     * @param array $item the menu item to be rendered. Please see {@link items} on what data might be in the item.
     *
     * @return string the rendered item
     */
    protected function renderMenuItem($item) {

        if (isset($item['icon'])) {
            if (strpos($item['icon'], 'icon') === false && strpos($item['icon'], 'fa') === false) {
                $item['icon'] = 'icon-' . implode(' icon-', explode(' ', $item['icon']));
            }

            $item['label'] = '<i class="' . $item['icon'] . '"></i> ' . $item['label'];
        }

        if (!isset($item['linkOptions'])) {
            $item['linkOptions'] = array();
        }

        $item['linkOptions']['tabindex'] = -1;

        if (isset($item['url'])) {
            return CHtml::link($item['label'], $item['url'], $item['linkOptions']);
        } else {
            return CHtml::link($item['label'], '#', array());
        }
    }

    /**
     *### .getDividerCssClass()
     *
     * Returns the divider CSS class.
     * @return string the class name
     */
    public function getDividerCssClass()
    {
        return 'divider';
    }

    /**
     *### .getDropdownCssClass()
     *
     * Returns the dropdown css class.
     * @return string the class name
     */
    public function getDropdownCssClass()
    {
        return 'collapsible-body';
    }

    /**
     *### .isVertical()
     *
     * Returns whether this is a vertical menu.
     * @return boolean the result
     */
    public function isVertical()
    {
        return true;
    }
}