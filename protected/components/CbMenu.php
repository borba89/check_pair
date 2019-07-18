<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 16.01.19
 * Time: 15:11
 */
//Yii::import('booster.widgets.TbMenu');
//Yii::import('booster.widgets.TbMenu');
class CbMenu extends CMenu
{
    protected function renderMenuItem($item) {

        if (isset($item['icon'])) {
            if (strpos($item['icon'], 'icon') === false && strpos($item['icon'], 'fa') === false) {
                $item['label'] = "<i class='material-icons'>".$item['icon']."</i>\r\n<span>" . $item['label'] . '</span>';
            } else {
                $item['label'] = "<i class='material-icons'>".$item['icon']."</i>\r\n<span>" . $item['label'] . '</span>';
            }
        }

        if (!isset($item['linkOptions'])) {
            $item['linkOptions'] = array();
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

        if (isset($item['url'])) {
            return CHtml::link($item['label'], $item['url'], $item['linkOptions']);
        } else {
            return $item['label'];
        }
    }

    protected function renderMenu($items) {

        $n = count($items);

        if ($n > 0) {

            echo CHtml::openTag('ul', $this->htmlOptions) . "\n";

            $count = 0;
            foreach ($items as $item) {
                $count++;

                if (isset($item['divider'])) {
                    echo "<li class=\"{$this->getDividerCssClass()}\"></li>\n";
                } else {
                    $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
                    $classes = array();

                    if ($item['active'] && $this->activeCssClass != '') {
                        $classes[] = $this->activeCssClass;
                    }

                    if ($count === 1 && $this->firstItemCssClass !== null) {
                        $classes[] = $this->firstItemCssClass;
                    }

                    if ($count === $n && $this->lastItemCssClass !== null) {
                        $classes[] = $this->lastItemCssClass;
                    }

                    if ($this->itemCssClass !== null) {
                        $classes[] = $this->itemCssClass;
                    }

                    if (isset($item['items'])) {
                        $classes[] = $this->getDropdownCssClass();
                    }

                    if (isset($item['disabled'])) {
                        $classes[] = 'disabled';
                    }

                    if (!empty($classes)) {
                        $classes = implode(' ', $classes);
                        if (!empty($options['class'])) {
                            $options['class'] .= ' ' . $classes;
                        } else {
                            $options['class'] = $classes;
                        }
                    }

                    echo CHtml::openTag('li', $options) . "\n";

                    $menu = $this->renderMenuItem($item);

                    if (isset($this->itemTemplate) || isset($item['template'])) {
                        $template = isset($item['template']) ? $item['template'] : $this->itemTemplate;
                        echo strtr($template, array('{menu}' => $menu));
                    } else {
                        echo $menu;
                    }

                    if (isset($item['items']) && !empty($item['items'])) {
                        $dropdownOptions = array(
                            'encodeLabel' => $this->encodeLabel,
                            'htmlOptions' => isset($item['submenuOptions']) ? $item['submenuOptions']
                                : $this->submenuHtmlOptions,
                            'items' => $item['items'],
                        );
                        $dropdownOptions['id'] = isset($dropdownOptions['htmlOptions']['id']) ?
                            $dropdownOptions['htmlOptions']['id'] : null;
                        echo "<div class='collapsible-body'>\n";
                        $this->controller->widget('application.components.CbDropdown', $dropdownOptions);
                        echo "</div>\n";
                    }

                    echo "</li>\n";
                }
            }

            echo "</ul>\n";
        }
    }

    protected function normalizeItems($items, $route, &$active)
    {
        foreach ($items as $i => $item) {
            if (!is_array($item)) {
                $item = array('divider' => true);
            } else {
                if (!isset($item['itemOptions'])) {
                    $item['itemOptions'] = array();
                }

                $classes = array();

                if (!isset($item['url']) && !isset($item['items'])) {
                    $item['header'] = true;
                    $classes[] = 'nav-header1';
                }

                if (!empty($classes)) {
                    $classes = implode($classes, ' ');
                    if (isset($item['itemOptions']['class'])) {
                        $item['itemOptions']['class'] .= ' ' . $classes;
                    } else {
                        $item['itemOptions']['class'] = $classes;
                    }
                }
            }

            $items[$i] = $item;
        }

        return parent::normalizeItems($items, $route, $active);
    }

    public function getDividerCssClass() {

        return (isset($this->type) && $this->type === self::TYPE_LIST) ? 'nav-divider' : 'divider-vertical';
    }

    /**
     *### .getDropdownCssClass()
     *
     * Returns the dropdown css class.
     *
     * @return string the class name
     */
    public function getDropdownCssClass() {

        return 'dropdown';
    }
}