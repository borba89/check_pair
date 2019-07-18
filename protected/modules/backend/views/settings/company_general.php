<?php
    $this->title = 'Manage General Settings';
    $this->breadcrumbs=array(
        'General Settings'=>array('admin', 'id' => Settings::GENERAL),
        'Manage',
    );
/*$this->menu=array(
    array('label'=>'Create General Setting','url'=>array('create')),
);*/
?>

<?php $this->widget('application.components.CmTabView', array(
    'htmlOptions'=>array(
        'class'=>'col s12'
    ),
    'activeTab'=>'tab1',
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'Контактные данные организации',
            'view'=>'_company_form_view',
            'data'=>array(
                'company_name'=>$company_name,
                'company_logo'=>$company_logo,
                'footer_logo'=>$footer_logo,
                'company_watermark'=>$company_watermark,
                'company_numbers'=>$company_numbers,
                'company_address_ru'=>$company_address_ru,
                'company_address_ro'=>$company_address_ro,
                'company_address_en'=>$company_address_en,
                'company_map'=>$company_map,
                'company_email'=>$company_email,
                'company_email_resume'=>$company_email_resume,
                'socials' => $socials
            ),
        ),
    ),
)); ?>


