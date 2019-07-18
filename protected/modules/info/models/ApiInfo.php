<?php

Yii::import('offer.models.ApiOperationFunctions');

class ApiInfo extends ApiOperationFunctions
{
    public function getInfoBlogs($criteria = false)
    {
        if (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $infoBlocks = InfoBlock::model()->findAll($criteria);
        return $infoBlocks;
    }
}