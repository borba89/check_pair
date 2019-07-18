<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

class Sidebar extends CWidget
{

    public function init()
    {
        $this->render('sidebar');
    }

    public function renderModuleMenu() {
        $allModule = explode('|', MODULES_MATCHES);
        $allModule = $this->correctPosition($allModule);

        if (!empty($allModule)) {
            foreach ($allModule as $moduleName) {
                $class = ucfirst($moduleName) . 'Module';
                Yii::import($moduleName . '.' . $class);

                if (method_exists($class, 'menuItem')) {
                    $sidebarItems = call_user_func($class. '::menuItem');
                    if (!empty($sidebarItems)) {
                        foreach ($sidebarItems as $menu) {
                            if (is_array($menu))
                                $this->moduleMenu($menu);
                            else {
                                $this->moduleMenu($sidebarItems);
                                break;
                            }
                        }
                    }
                }
            }
        }
    }

    protected function moduleMenu($menu) {
        $sidebar_tab_array = array();
        $innrMenu = '';

        if (isset($menu['items'])) {
            foreach($menu['items'] as $item) {
                $sidebar_tab_array[] = $item['sidebar_tab'];

                $innrMenu .= '<li '.$this->is_open($item['sidebar_tab'], 'li').'>';
                $innrMenu .= CHtml::openTag('a', CMap::mergeArray(array('href' => Yii::app()->createUrl($item['url'])), isset($item['linkOptions']) ? $item['linkOptions'] : array()));
                $innrMenu .= $item['label'];
                $innrMenu .= CHtml::closeTag('a');
                $innrMenu .= '</li>';
            }
        } else
            $sidebar_tab_array[] = $menu['sidebar_tab'];

        echo '<li '.$this->is_open($sidebar_tab_array).'>';
        if ($innrMenu) {
            echo CHtml::openTag('a', array('href' => 'javascript:;'));
        } else {
            echo CHtml::openTag('a', array(
                'href' => $menu['url'],
                'class' => "collapsible-header waves-effect waves-grey ".$this->is_open($sidebar_tab_array, 'a')));
        }
        echo CHtml::openTag('i', array('class' => 'material-icons'));
        echo $menu['icon'];
        echo CHtml::closeTag('i');
        echo CHtml::tag('span', array(), $menu['label']);
        echo CHtml::closeTag('a');

        if ($innrMenu) {
            echo '<ul class="acc-menu" '.$this->is_open($sidebar_tab_array, 'ul').'>';
            echo $innrMenu;
            echo '</ul>';
        }
        echo '</li>';
    }

    public function is_open($sidebarTab, $style=NULL) {
        switch($style) {
            case 'ul' :
                if (is_array($sidebarTab)) {
                    return in_array($this->controller->sidebar_tab, $sidebarTab) ? 'style="display:block"' : '';
                } else {
                    return $this->controller->sidebar_tab == $sidebarTab ? 'style="display:block"' : '';
                }
                break;
            case 'li' :
                if (is_array($sidebarTab)) {
                    return in_array($this->controller->sidebar_tab, $sidebarTab) ?
                        'class="no-padding active"' : 'class="no-padding"';
                } else {
                    return $this->controller->sidebar_tab == $sidebarTab ?
                        'class="no-padding active"' : 'class="no-padding"';
                }
                break;
            case 'a' :
                if (is_array($sidebarTab)) {
                    return in_array($this->controller->sidebar_tab, $sidebarTab) ?
                        'active' : '';
                } else {
                    return $this->controller->sidebar_tab == $sidebarTab ?
                        'active' : '';
                }
                break;
            default:
                if (is_array($sidebarTab)) {
                    return in_array($this->controller->sidebar_tab, $sidebarTab) ?
                        'class="no-padding active"' : 'class="no-padding"';
                } else {
                    return $this->controller->sidebar_tab == $sidebarTab ?
                        'class="no-padding active"' : 'class="no-padding"';
                }
        }
    }

    private function correctPosition($modules)
    {
        $posArray = array();
        foreach ($modules as $moduleName) {
            $class = ucfirst($moduleName) . 'Module';
            Yii::import($moduleName . '.' . $class);

            if (method_exists($class, 'menuItem')) {
                $sidebarItems = call_user_func($class. '::menuItem');
                $posArray[$sidebarItems['position']] = $moduleName;
            }
        }

        ksort($posArray);
        return $posArray;
    }
}