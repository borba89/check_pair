<?php
class Slider extends CWidget
{
    public $model;

    public function init() {
        if ($this->model) {
            if ($images = $this->model->contypeImagesList) {
                Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule('backend')->assetsUrl.'/js/pages/ui-carousel.js', CClientScript::POS_END);
                $this->render('slider', array('images' => $images));
            }
        }
    }
}