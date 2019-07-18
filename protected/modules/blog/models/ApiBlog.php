<?php

Yii::import('offer.models.ApiOperationFunctions');

class ApiBlog extends ApiOperationFunctions
{
    public function getBlogs($criteria = false)
    {
        if (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $criteria->select = '*, DATE_FORMAT(updated, "%Y-%m-%d") as updated';
        $criteria->scopes = array('active');
        $criteria->order = 'updated DESC';

        $realtyOffers = BlogArticle::model()->search($criteria);
        return $realtyOffers;
    }

    public function getBlog($id)
    {
        $blogArticle = BlogArticle::model()->active()->findByPk($id);
        if ($blogArticle) {
            $blogArticle->saveCounters(array('views'=>1));
            return $blogArticle;
        }
    }
}