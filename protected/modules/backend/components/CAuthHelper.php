<?php

class CAuthHelper {
	static function isAdminOrOwner($id) {
        if(Yii::app()->user->id == 1) return true;
		if($id == Yii::app()->user->id) return true;

        return true;
	}
}