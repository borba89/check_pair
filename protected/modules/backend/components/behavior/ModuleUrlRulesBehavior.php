<?php
class ModuleUrlRulesBehavior extends CBehavior
{
    public $beforeCurrentModule = array();
    public $afterCurrentModule = array();

    public function events()
    {
        return array_merge(parent::events(),array(
            'onBeginRequest'=>'beginRequest',
        ));
    }

    public function beginRequest($event)
    {
        $module = $this->_getCurrentModuleName();

        $list = array_merge(
            $this->afterCurrentModule,
            array($module),
            $this->beforeCurrentModule
        );

        foreach ($list as $name)
            Url::import($name);
    }

    protected function _getCurrentModuleName()
    {
        $route = Yii::app()->getRequest()->getPathInfo();
        $domains = explode('/', $route);
        $moduleName = array_shift($domains);
        return $moduleName;
    }
}