<?php
$this->title = Yii::t('BackendModule.backend', 'Редактирование пункта меню');
$this->menu = array(
    array('label' => Yii::t('BackendModule.backend','Управление меню'), 'url' => array('/backend/menu')),
    array('label' => Yii::t('BackendModule.backend','Создать меню'), 'url' => array('/backend/menu/create')),
    array('label' => Yii::t('BackendModule.backend','Удалить пункт меню'), 'url' => array('/backend/item/delete', 'id'=>$model->id)),
);
?>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'menus'=>$menus,
    'menuId'=>$menuId
));
?>