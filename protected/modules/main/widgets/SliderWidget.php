<?php
Yii::import('offer.models.RealtyOffer');

class SliderWidget extends CWidget
{
    public $model;

    public function init() {
        if (!$this->model) {
            $realtyOffers = RealtyOffer::model()->active()->with('realty')->findAll('main_page = 1');
        }

        if (isset($realtyOffers)) {
            $this->render('slider-view', array('realtyOffers' => $realtyOffers));
        } elseif (isset($this->model)) {
            $this->render('single-view', array('model' => $this->model));
        }
    }
}