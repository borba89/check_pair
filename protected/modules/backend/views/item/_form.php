<div class="form">

    <?php
    $form = $this->beginWidget('backend.components.ActiveForm', array(
        'id' => 'menu-item-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
            ));

    echo $form->errorSummary($model);
    ?>

    <div class="row">
        <?php //echo $form->labelEx($model, 'name_en'); ?>
        <?php echo $form->textFieldGroup($model, 'name_en', array('size' => 60, 'maxlength' => 128)); ?>
        <?php //echo $form->error($model, 'name_en'); ?>
    </div><!-- row -->

    <div class="row">
        <?php //echo $form->labelEx($model, 'name_ro'); ?>
        <?php echo $form->textFieldGroup($model, 'name_ro', array('size' => 60, 'maxlength' => 128)); ?>
        <?php //echo $form->error($model, 'name_ro'); ?>
    </div><!-- row -->

    <div class="row">
        <?php //echo $form->labelEx($model, 'name_ru'); ?>
        <?php echo $form->textFieldGroup($model, 'name_ru', array('size' => 60, 'maxlength' => 128)); ?>
        <?php //echo $form->error($model, 'name_ru'); ?>
    </div><!-- row -->

    <div class="row">

        <?php echo CHtml::hiddenField('MMenuItem[type]', 'url'); ?>
        <label for="MMenuItem_name_ro" class="required">Link EN <span class="required">*</span></label>
        <?php echo CHtml::textField('MMenuItem[url_en]', $model->link_en, array('size' => 60, 'onfocus' => 'js:$("#radio_url").attr("checked", "checked");')); ?>
        <?php echo $form->error($model, 'link_en'); ?>
        <br/>
        <label for="MMenuItem_name_ro" class="required">Link RO <span class="required">*</span></label>
        <?php echo Chtml::textField('MMenuItem[url_ro]', $model->link_ro, array('size' => 60, 'onfocus' => 'js:$("#radio_url").attr("checked", "checked");')); ?>
        <?php echo $form->error($model, 'link_ro'); ?>
        <br/>
        <label for="MMenuItem_name_ro" class="required">Link RU <span class="required">*</span></label>
        <?php echo Chtml::textField('MMenuItem[url_ru]', $model->link_ru, array('size' => 60, 'onfocus' => 'js:$("#radio_url").attr("checked", "checked");')); ?>
        <?php echo $form->error($model, 'link_ru'); ?>
        <br/>
        <p class="hint">
            /item отображается как base_url/item, //item points как root_of_server/item, ссылки отображаются как есть.
        </p>
    </div><!-- row -->

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div><!-- row -->

    <div class="row">
        <?php //echo $form->labelEx($model, 'enabled'); ?>
        <?php echo $form->checkBox($model, 'enabled'); ?>
        <?php echo $form->labelEx($model, 'enabled'); ?>
        <?php //echo $form->error($model, 'enabled'); ?>
    </div><!-- row -->

    <div class="row">
        <?php echo $form->labelEx($model, 'role'); ?>
        <br>
        <?php
        echo CHtml::checkBoxList(get_class($model) . '[role]', explode(',', $model->role), $model->roles, array('selected' => 'all'));
        ?>
        <?php echo $form->error($model, 'role'); ?>
    </div><!-- row -->


    <div class="row">

        <?php echo CHtml::checkBox('MMenuItem[target]', $model->target == '_blank', array('value' => '_blank')); ?>
        <?php echo $form->labelEx($model, 'Открывать в новом окне?'); ?>
        <?php echo $form->error($model, 'target'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php
        //show all menu items but current one
        $allModels = MMenuItem::model()->findAllByAttributes(array(
            'menu_id'=> $menuId
        ));
        foreach ($allModels as $key => $aModel) {
            if ($aModel->id == $model->id)
                unset($allModels[$key]);
        }
        echo $form->dropDownList($model, 'parent', CHtml::listData($allModels, 'id', 'name'), array('prompt' => 'Нет'));
        ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div><!-- row -->

    <?php
    //menu selection available only for edit
    if (isset($menuId))
        echo $form->hiddenField($model, 'menu', array('value' => $menuId));
    else {
        ?>
        <div class="row">
            <?php //echo CVarDumper::dump($menus,10,true);?>
            <?php echo $form->labelEx($model, 'menu_id'); ?>
            <?php echo $form->dropDownList($model, 'menu', CHtml::listData($menus, 'id', 'name')); ?>
            <?php echo $form->error($model, 'menu_id'); ?>
        </div>
        <?php
    }
    ?>

    <div class="row buttons">
        <?php
        echo CHtml::submitButton(Yii::t('BackendModule.backend', 'Сохранить'), array('class'=>'btn btn-primary'));
        echo CHtml::Button(Yii::t('BackendModule.backend', 'Отменить'), array(
            'class'=>'btn btn-info',
            'submit' => 'javascript:history.go(-1)'));
        ?>
    </div>
    <?php
    $this->endWidget();
    ?>
</div>