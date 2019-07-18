<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 16.01.19
 * Time: 14:35
 */

class BackendMenu extends CWidget
{
    public $items;

    public function run()
    {
        $this->render('backend_menu', array('items'=>$this->items));
    }
}