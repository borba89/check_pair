<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DAdminAction extends DCrudAction
{
    /**
     * @var string view file for rendering
     */
    public $view = 'admin';
    /**
     * @var string view for rendering for Ajax request
     */
    public $ajaxView = '';
    /**
     * @var string search scenarion name
     */
    public $scenario = 'search';

    public $layout = null;
    public $excel = false;
    public $excelParam = 'export';

    public function run()
    {
        $model = $this->createModel();
        $modelName = get_class($model);

        if($this->layout)
            $this->controller->layout = $this->layout;

        if($model->asa('nestedSetBehavior')) {
            $items = $model::model()->findAll(array('order'=>'priority, root, lft, id'));
            $this->controller->render($this->view, array('items'=>$items));
            Yii::app()->end();
        }

        $model = new $modelName($this->scenario);

        $model->unsetAttributes();
        if (isset($_GET[$modelName])) {
            $model->attributes=$_GET[$modelName];
        }

        if ($this->ajaxView && Yii::app()->request->isAjaxRequest) {
            $this->controller->renderPartial($this->ajaxView,array(
                'model'=>$model,
            ));
        } else {
            $retArr = array('model'=>$model);
            if ($this->excel) {
                $attribute = Yii::app()->request->getParam($this->excelParam, null);

                if (!empty($attribute))
                    $retArr = CMap::mergeArray($retArr, array('production' => 'export'));
                else
                    $retArr = CMap::mergeArray($retArr, array('production' => 'grid'));
            }
            $this->controller->render($this->view, $retArr);
        }
    }
}
