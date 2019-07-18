<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DDeleteAction extends DCrudAction
{
    /**
     * @var string success message
     */
    public $success = 'Deleted successfully';
    /**
     * @var string error message
     */
    public $error = 'Invalid request. Please do not repeat this request again.';

    public function run()
    {
        $this->checkIsPostRequest();

        $model = $this->loadModel();

        $this->clientCallback('beforeDelete', $model);

        $method = $model->asa('nestedSetBehavior') ? 'deleteNode' : 'delete';
        if ($model->{$method}())
            $this->success($this->success);
        else
            $this->error($this->error);

        $this->redirectToReferrer();
    }
}
