<?php
$this->title = Yii::t('BackendModule.backend', 'Создание нового меню');

$this->menu = array(
    array('label' => Yii::t('BackendModule.backend','Управление меню'), 'url' => array('/backend/menu')),
);
?>

<?php
$this->renderPartial('_form', array(
            'model' => $model,
            'buttons' => 'create'
));

?>