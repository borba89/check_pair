<?php
class CAuthHelper
{
	static function isUsersCAbinet()
    {
        $is_user = Yii::app()->user->is_user;

        if(!$is_user) return false;
        return true;
	}
}