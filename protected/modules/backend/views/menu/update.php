<?php
$this->title = Yii::t('BackendModule.backend', 'Редактирование меню');
$this->menu = array(
    array('label' => Yii::t('BackendModule.backend','Управление меню'), 'url' => array('/backend/menu')),
    array('label' => Yii::t('BackendModule.backend','Создать меню'), 'url' => array('/backend/menu/create')),
);
?>

<?php
$this->renderPartial('_form', array(
    'model' => $model));
?>