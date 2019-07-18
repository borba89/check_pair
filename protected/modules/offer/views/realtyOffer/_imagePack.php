<?php
$tCriteria = new CDbCriteria();
$tCriteria->condition = 'item_id = :item_realty && content_type = "realty"';
$tCriteria->addCondition('item_id = :item_offer && content_type = "realtyoffer"', 'OR');
$tCriteria->params[':item_realty'] = $model->realty_id;
$tCriteria->params[':item_offer'] = ($model->isNewRecord)?$model->getTempId():$model->realty_id;
$images = MultipleImages::model()->findAll($tCriteria);

if ($images) {
    foreach ($images as $image) {
        echo $this->renderPartial("application.modules.backend.views.multiapload._image", array('image'=>$image));
    }
}