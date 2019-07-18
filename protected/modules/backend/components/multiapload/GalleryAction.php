<?php
class GalleryAction extends DCrudAction
{
    public function run()
    {
        $id = $_POST["id"];
        $instance = $this->createModel();
        $model = $instance->findByPk($id);

        if ($model) {
            //Это кутомный рендом
            echo $this->controller->renderPartial('application.modules.backend.views.multiapload._images', array("model" => $model));
        //Это из плагина
//            echo $this->controller->renderPartial('application.modules.backend.components.views.uploadifyRow._images', array("model" => $model, "attribute" => 'path','relation'=> 'contypeImagesList'));
        } elseif (($instance instanceof Realtyoffer || $instance instanceof Realty) && !is_numeric($id)) {
            $realty_id = isset($_POST["realty_id"]) ? $_POST["realty_id"] : null;

            if (empty($realty_id)) {
                $realty_id = isset($_POST["id"]) ? $_POST["id"] : null;
            }

            echo $this->controller->renderPartial('application.modules.backend.views.multiapload._tempImages', array("tempId" => $id, 'realty_id' => $realty_id));
        }
    }
}