<?php
    $label = $model->isNewRecord ? "Создать" : "Сохранить";
    Yii::app()->clientScript->registerScript('button-label', '
                        var buttonLabel = \'' . $label . '\'
                    ', CClientScript::POS_HEAD);

	$this->breadcrumbs=array(
        'Realty Offers'=>array('admin'),
        'Manage',
    );

    $this->title = Yii::t('BackendModule.backend', 'Объявления');
?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('/backend') ?>"><?php echo Yii::t('BackendModule.backend', 'HQ')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo Yii::t('BackendModule.backend', 'Объявления') ?></li>
    </ol>
<?php $this->widget('application.components.CmTabView', array(
    'htmlOptions'=>array(
        'class'=>'col s12'
    ),
    'activeTab'=>'tab1',
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'Недвижимость',
            'view'=>'_offer_view',
            'data'=>array(
                'dataProvider'=>$model->search()
            )
        ),
        'tab2'=>array(
            'title'=>'Вакансии',
            'view'=>'_vacancy_view',
            'data'=>array(
                'dataProvider'=>Vacancy::model()->search()
            )
        )
    )
));?>




