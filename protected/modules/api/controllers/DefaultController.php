<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

class DefaultController extends CController
{
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            Yii::app()->ajax->failure($error['message']);
        }
    }
}
