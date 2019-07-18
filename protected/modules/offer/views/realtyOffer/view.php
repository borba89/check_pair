<?php
    $label = $model->isNewRecord ? "Создать" : "Сохранить";
    Yii::app()->clientScript->registerScript('button-label', '
            var buttonLabel = \'' . $label . '\'
        ', CClientScript::POS_HEAD);

	$this->breadcrumbs=array(
        'Realty Offers'=>array('admin'),
        $model->title_ru,
    );

	$updateUrl = array('update','id'=>$model->id);
	if(Yii::app()->settings->get(Settings::GENERAL, 'ad_creation')){
        $updateUrl = array('updateAd','id'=>$model->id);
    }

    $this->menuModel = $model;
    $this->activeAddress = Yii::app()->createUrl('/offer/realtyOffer/lotToggle', array('id' => $model->id));
    $this->menu=array(
        array('label'=>'Назад','url'=>array('admin')),
        array('label'=>'Создать аукцион','url'=>array('auction', 'id'=>$model->id)),
        array('label'=>'Снять объявление','url'=>'',
            'linkOptions'=>array('id' => 'closeLot')
        ),
        array('label'=>'Разместить объявление','url'=>'',
            'linkOptions'=>array('id' => 'openLot')
        ),
        array('label'=>'Изменить объявление','url'=>$updateUrl, 'linkOptions'=>array('id' => 'updateLot')),
        array('label'=>'Удалить объявление','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Объект недвижимости будет удалён и вы не сможете восстановить его позже. Пожалуйста, подтвердите операцию', 'id' => 'deleteLot')),
    );
    $this->title = "Просмотр: ".$model->title_ru;
?>

<?php $this->widget('offer.widgets.Slider', array('model' => $model)); ?>

<?php $this->widget('booster.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'title_ru',
        'title_ro',
        'title_en',
        [
            'name' => 'description_ru',
            'type' => 'raw'
        ],
        [
            'name' => 'description_ro',
            'type' => 'raw'
        ],
        [
            'name' => 'description_en',
            'type' => 'raw'
        ],
        'type:realtyOfferType',
        [
            'name' => 'ammount',
            'value' => function($data) {
                $month = '';
                if ($data->bid_type == RealtyOffer::PERMONTH) {
                    $month = Yii::t("base", ' / в месяц');
                }

                return $data->ammount
                    . ' ' . Yii::app()->format->currency($data->currency)
                    . $month . ' (' . Yii::app()->format->RealtyOfferType($data->type) . ')';
            }
        ],
        'views_ru',
        'views_ro',
        'views_en',
        'add_favorite_ru',
        'add_favorite_ro',
        'add_favorite_en',
        'remove_favorite',
    ),
)); ?>
