<?php
class PerformanceFilter extends CFilter
{
    private $no_ssID_check = array();
    private $no_json_check = array();

    protected function preFilter($filterChain)
    {
        if(!in_array($filterChain->action->id, $this->no_json_check)) {
            Yii::app()->controller->POST = json_decode(Yii::app()->request->getRawBody());

            if(!Yii::app()->controller->POST)
                Yii::app()->ajax->failure(Yii::t("base", 'Not json data'));
        } else
            Yii::app()->controller->POST = $this->array_to_object($_POST);

        if(!Yii::app()->request->isPostRequest)
            Yii::app()->ajax->failure(Yii::t("base", 'Error, no POST data'));

        if(!in_array($filterChain->action->id, $this->no_ssID_check) && isset(Yii::app()->controller->POST->token)) {
            $token = trim(Yii::app()->controller->POST->token);
            $user = User::model()->find('MD5(email) = :token', array(':token' => $token));

            if (!$user)
                Yii::app()->ajax->failure(Yii::t("base", 'Token wrong'));
            else {
                Yii::app()->controller->author = $user->id;
                //Yii::app()->user->id = $user->id;
            }

            return true;
        }

        if(!in_array($filterChain->action->id, $this->no_ssID_check))
            Yii::app()->ajax->failure(Yii::t("base", 'Error, token should be sent'));
        else
            return true;
    }

    private function array_to_object($array) {
        $obj = new stdClass;
        foreach($array as $k => $v) {
            if(strlen($k)) {
                if(is_array($v)) {
                    $obj->{$k} = $this->array_to_object($v); //RECURSION
                } else {
                    $obj->{$k} = $v;
                }
            }
        }
        return $obj;
    }
}