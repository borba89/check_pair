<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DCreateAction extends DCrudAction
{
    /**
     * @var string view file for rendering
     */
    public $view = 'create';
    public $redirect = 'view';

    public function run()
    {
        $model = $this->createModel();

        $modelName = get_class($model);

        $this->clientCallback('performAjaxValidation', $model);

        if (isset($_POST[$modelName])) {
            $model->attributes = $_POST[$modelName];

            //echo CVarDumper::dump($model->attributes,10,true);exit;

            $this->clientCallback('beforeCreate', $model);

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
