<?php
$label = $model->isNewRecord ? "Создать" : "Сохранить";
Yii::app()->clientScript->registerScript('button-label', '
        var buttonLabel = \'' . $label . '\'
    ', CClientScript::POS_HEAD);

/**
 * @var $model Realty
 */

	$this->breadcrumbs=array(
        'Blog Articles'=>array('admin'),
        $model->id,
    );

    $this->menuModel = $model;
    $this->activeAddress = Yii::app()->createUrl('/realty/realty/lotToggle', array('id' => $model->id));
    $this->menu=array(
        array('label'=>'Назад','url'=>array('admin')),
        array('label'=>'Закрыть лот','url'=>'',
            'linkOptions'=>array('id' => 'closeLot')
        ),
        array('label'=>'Открыть лот','url'=>'',
            'linkOptions'=>array('id' => 'openLot')
        ),
        array('label'=>'Изменить объект недвижимости','url'=>array('update','id'=>$model->id), 'linkOptions'=>array('id' => 'updateLot')),
        array('label'=>'Удалить лот','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Объект недвижимости будет удалён и вы не сможете восстановить его позже. Пожалуйста, подтвердите операцию', 'id' => 'deleteLot')),
    );
    $this->title = "Просмотр: ".Realty::model()->getRealtyType($model->type).', '.$model->addressTable->getAddress();
?>

<?php $additionalInfo = $model->realtyDetailed->viewAdditional(); ?>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=> CMap::mergeArray(array(
    'type:realtyCategory',
    array(
        'label' => Yii::t("RealtyModule.realty", 'Страна'),
        'value' => function($data) {
            if ($address = $data->addressTable) {
                return $address->getCountries($address->country);
            }

            return 'N/A';
        }
    ),
    array(
        'label' => Yii::t("RealtyModule.realty", 'Город'),
        'value' => function($data) {
            if ($address = $data->addressTable) {
                return $address->getCities($address->city);
            }

            return 'N/A';
        }
    ),
    array(
        'label' => Yii::t("RealtyModule.realty", 'Район'),
        'value' => function($data) {
            if ($address = $data->addressTable) {
                return $address->getDistrict($address->city_district);
            }

            return 'N/A';
        }
    ),
    array(
        'label' => Yii::t("RealtyModule.realty", 'Улица'),
        'value' => function($data) {
            if ($address = $data->addressTable) {
                return $address->street;
            }

            return 'N/A';
        }
    ),
    'description:html',
    'status:status',
), $additionalInfo),
)); ?>
