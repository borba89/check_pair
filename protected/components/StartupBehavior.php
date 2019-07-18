<?php
Yii::import('landing.models.LandingCountry');

class StartupBehavior extends CBehavior{
    public function attach($owner) {
        $owner->attachEventHandler('onBeginRequest', array($this, 'beginRequest'));
    }

    public function beginRequest(CEvent $event) {
        /*$landing = LandingCountry::model()->find('homepage = 1');

        if (!$landing) {
            $criteria=new CDbCriteria;
            $criteria->order = 'id ASC';
            $landing = LandingCountry::model()->find($criteria);
        }*/

        Yii::app()->language = 'en';
    }
}