<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DTreeAction extends DCrudAction
{
    public function run()
    {
        if (isset($_POST["ids"])) {
            $ids = Yii::app()->request->getPost('ids');
            foreach ($ids as $key => $id) {
                if(empty($id["item_id"])) continue;
                $menu = $this->controller->loadModel((int)$id["item_id"]);
                if(isset($menu->flash_messages))
                    $menu->flash_messages = false;

                if ($menu && (int)$id["item_id"] != 0) {
                    $menu->priority = $key;
                    $menu->saveNode();
                    if (!empty($id["parent_id"]) && $id["parent_id"] != "root") {
                        $root = $this->controller->loadModel((int)$id["parent_id"]);
                        $menu->moveAsLast($root);
                    } else {
                        if (!$menu->isRoot())
                            $menu->moveAsRoot();
                    }
                }
            }
            echo json_encode($ids);
        }
    }
}