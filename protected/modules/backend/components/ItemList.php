<?php

class ItemList extends CWidget {

    public $items;
    public $activeId = 2;
    public $id;
    public $css = true;
    private $_processed = array();

    public function init() {
        //$this->id = 'menu-list-item-1';
        if ($this->css) {
            $css = "
            ";
            //Yii::app()->clientScript->registerCoreScript('jquery');
            //Yii::app()->clientScript->registerCoreScript('jquery.ui');
            //Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule('backend')->assetsDirectory . '/nestedsortable/jquery.ui.nestedSortable.js');
            //Yii::app()->clientScript->registerCssFile(Yii::app()->getModule('backend')->assetsDirectory . '/nestedsortable/nestedSortable.css');
            //Yii::app()->clientScript->registerCss('AtHerList', $css);
        }
    }

    public static function depthSort($a, $b) {
        //return $a->depth > $b->depth;
    }

    public static function leftSort($a, $b) {
        return $a->lft > $b->lft;
    }

    public static function echoer($a) {
        print_r($a->id);
    }

    public function run() {

        //sort items first to move deeper items to last
        usort($this->items, 'self::depthSort');
        usort($this->items, 'self::leftSort');

        echo '<div class="header-wrapper row" style="height:20px">';
        echo '<div class="col s3"><b>Заголовок</b></div> ';
        echo '<div class="col s6"><b>Описание</b></div> ';
        echo '<div class="col s2"><b>Опубликовано</b></div>';
        echo '<div class="col s1">&nbsp;</div>';
        echo "</div>";
        echo '<ul id="' . $this->id . '" class="sortable ui-sortable menu-item-list">
            ';
        foreach ($this->items As $row):
            if (in_array($row->id, $this->_processed))
                continue;
            $this->getRender($row);
            if ($row->children()) {
                echo "<ul>";
                $children = $row->children;
                //array_map('self::echoer',$children);
                //usort($children, 'self::depthSort');
                //usort($children, 'self::leftSort');
                $this->getchildren($children);
                echo "</ul>";
            }
            echo "</li>";
        endforeach;
        echo '</ul>';
    }

    public function getchildren($items) {
        usort($items, 'self::leftSort');
        //array_map('self::echoer', $items);
        foreach ($items As $row):
            $this->getRender($row);
            if ($row->children()) {
                echo "<ul>";
                $this->getchildren($row->children());
                echo "</ul>";
            }
            echo "</li>";
        endforeach;
    }

    public function getRender($row) {
        $this->_processed[] = $row->id;
        echo '<li id="list_' . $row->id . '" class="row">';
        ?>
        <div style="height:20px;" class="item-wrapper <?php echo ($this->activeId == $row->id) ? 'active' : ''; ?>">
            <div class="col s3">
                <b><label><?php echo $row->getName(); ?></label></b>
            </div>
            <div class="col s6">
                <?php echo $row->description; ?>
            </div>
            <div class="col s2">
                <input type="checkbox" disabled="disabled" <?php echo($row->enabled) ? "checked" : ""; ?>>
                <label></label>
            </div>
            <div class="col s1">
                <a href="<?php echo Yii::app()->createUrl('/backend/item/edit/', array('id'=>$row->id)); ?>" title="Редактировать">
                    <i class="material-icons">description</i>
                </a>
            </div>
        </div>

        <?php
    }

}