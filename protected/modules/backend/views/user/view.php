<?php
    $label = $model->isNewRecord ? "Создать" : "Сохранить";
    Yii::app()->clientScript->registerScript('button-label', '
            var buttonLabel = \'' . $label . '\'
        ', CClientScript::POS_HEAD);

    $this->title = "Просмотр: ".$model->name.' '.$model->surname;

    $this->menuModel = $model;
    $this->activeAddress = Yii::app()->createUrl('/backend/user/lotToggle', array('id' => $model->id));

    $this->menu[] = array('label'=>'Назад','url'=>array('admin'));

    if ($model->id != Yii::app()->user->id) {
        $this->menu[] = array('label'=>'Отключить пользователя','url'=>'',
            'linkOptions'=>array('id' => 'closeLot')
        );
    }

    if ($model->id != Yii::app()->user->id) {
        $this->menu[] = array('label' => 'Включить пользователя', 'url' => '',
            'linkOptions' => array('id' => 'openLot')
        );
    }
    $this->menu[] = array('label'=>'Исправить пользователя','url'=>array('update','id'=>$model->id), 'linkOptions'=>array('id' => 'updateLot'));

    $this->menu[] = array(
        'label'=>'Выход',
        'url'=>array('/backend/default/logout'),
    );

    if ($model->id != Yii::app()->user->id) {
        $this->menu[] = array('label'=>'Удалить пользователя','url'=>'#','linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>'Пользователь будет удален, и вы не сможете восстановить его позже. Пожалуйста, подтвердите операцию',
            'id' => 'deleteLot')
        );
    }

    $this->breadcrumbs=array(
        'Users'=>array('admin'),
        'View user #'.$model->id,
    );
?>

<?php $this->widget('booster.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes' => array(
        array(
            'name'=>'photo',
            'value'=>CHtml::image($model->getAvatarSrc(), '', array('width'=>128)),
            'type'=>'raw'
        ),
        'name',
        'surname',
        'email',
        'is_active:boolean',
        'last_login:dateTime',
        'date_joined:dateTime',
        array(
            'label'=>Yii::t('BackendModule.backend', 'Телефоны'),
            'value'=>$model->viewPhones(),
            'type'=>'raw'
        ),
    )
)); ?>
