<?php
Yii::import('offer.models.RealtyOffer');

class PreviewSliderWidget extends CWidget
{
    public $images;
    public $post;
    public $realty;

    public function init() {
        if ($this->images && isset($this->post)) {
            $this->render(
                'slider-preview',
                array(
                    'images' => $this->images,
                    'post' => $this->post,
                    'realty' => $this->realty
                )
            );
        }
    }

    public function getPostValue($value)
    {
        if (isset($this->post[$value])) {
            return $this->post[$value];
        }

        return null;
    }

    public function getPrice()
    {
        if ($this->getPostValue('type') == RealtyOffer::RENT) {
            return $this->getPostValue('ammount')
                . ' ' . $this->getPostValue('currency') . '/' . Yii::t("MainModule.main", "месяц");
        } else {
            return $this->getPostValue('ammount') . ' ' . $this->getPostValue('currency');
        }
    }
}