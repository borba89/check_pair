<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DBoosterEditableAction extends DCrudAction
{
    /**
     * @var string success message
     */
    public $success = 'Changed successfully';
    /**
     * @var string error message
     */
    public $error = 'Error';

    public function run()
    {
        $this->checkIsPostRequest();
        $this->checkIsAjaxRequest();

        $name = $this->getAttribute('name');
        $value = $this->getAttribute('value');
        $pk = $this->getAttribute('pk');

        if (!isset($name, $pk)) {
            throw new CHttpException(404);
        }

        $model = $this->loadModel('pk');

        $this->clientCallback('beforeToggle', $model);

        $model->$name = $value;

        if ($model->save())
            Yii::app()->ajax->success();
        else
            Yii::app()->ajax->rawText($model->getError($name), 500);
    }

    protected function getAttribute($attribute)
    {
        $attribute = Yii::app()->request->getParam($attribute);

        if (!isset($attribute))
            throw new CHttpException(400, Yii::t('BackendModule.backend', 'Missing attribute {attribute}', array('{attribute}'=>$attribute)));

        return $attribute;
    }
}
