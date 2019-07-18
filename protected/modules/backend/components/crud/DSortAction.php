<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.0
 */

class DSortAction extends DCrudAction
{
    /**
     * @var string success message
     */
    public $success = 'Changed successfully';
    /**
     * @var string error message
     */
    public $error = 'Error';
    /**
     * @var mixed toggable attributes
     */
    public $attributes = array('ord');

    public function run()
    {
        $this->checkIsPostRequest();

        $attribute = $this->getAttribute();
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            $i = 0;
            foreach ($_POST['items'] as $item) {
                $modelName = $this->createModel();
                $model = $modelName->findByPk($item);
                $model->scenario = 'sort';
                $model->$attribute = $i;
                $model->update();
                $i++;
            }
        }
    }

    protected function getAttribute()
    {
        if (empty($this->attributes))
            throw new CHttpException(400, Yii::t('BackendModule.backend', 'DToggleAction::attributes is empty'));

        $attribute = Yii::app()->request->getParam('attribute');

        if (!in_array($attribute, $this->attributes))
            throw new CHttpException(400, Yii::t('BackendModule.backend', 'Missing attribute {attribute}', array('{attribute}'=>$attribute)));

        return $attribute;
    }
}
