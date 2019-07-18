<?php

class Url
{
    protected static $data = array();

    public static function import($moduleName)
    {
        if($moduleName && Yii::app()->hasModule($moduleName))
        {
            if (!isset(self::$data[$moduleName]))
            {
                $class = ucfirst($moduleName) . 'Module';
                Yii::import($moduleName . '.' . $class);

                if(method_exists($class, 'urlRules'))
                {
                    $urlManager = Yii::app()->getUrlManager();
                    $urlManager->addRules(call_user_func($class .'::urlRules'), false);
                }

                self::$data[$moduleName] = true;
            }
        }
    }

    public static function redirectUrl($url)
    {
        if (strpos($url, ':') || (!empty(Yii::app()->baseUrl) && strpos($url, Yii::app()->baseUrl) !== false)) {
            return $url;
        }

        return Yii::app()->createAbsoluteUrl($url);
    }
}
