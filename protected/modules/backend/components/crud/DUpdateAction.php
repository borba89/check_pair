<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DUpdateAction extends DCrudAction
{
    /**
     * @var string view file for rendering
     */
    public $view = 'update';
    /**
     * @var string layout file
     */
    public $layout = null;
    public $redirect = 'view';

    public function run()
    {
        $model = $this->loadModel();

        if($this->layout)
            $this->controller->layout = $this->layout;

        $modelName = get_class($model);

        // uncomment if ajax validation is needed
        $this->clientCallback('performAjaxValidation', $model);

        if(isset($_POST[$modelName]))
        {
            $model->attributes = $_POST[$modelName];

            $this->clientCallback('beforeUpdate', $model);

            $method = $model->asa('nestedSetBehavior') ? 'saveNode' : 'save';
            if($model->{$method}()) {
                if ($this->redirect)
                    $this->redirectToView($model, $this->redirect);
                elseif (empty($this->redirect) || $this->redirect == 'admin')
                    $this->redirectToManagePage();
            }
        }

        $this->controller->render($this->view, array(
            'model'=>$model,
        ));
    }
}
