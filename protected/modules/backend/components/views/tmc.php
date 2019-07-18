<?php

/**
 * @var $model CActiveRecord
 * @var $this  ActiveForm
 * @var $attribute string
 * @var $htmlOptions array
 * @var $active_id string
 * @var $button_position string
 */

/**
 * Widget for TinyMce and Bootstrap
 * Initializing model name and attribute concatenation
 */
$unique_name = $active_id . "_modal";
$unique_name_textarea = $active_id . "_textarea";
$basic_name_id = "#" . $active_id;
$unique_name_id = "#" . $unique_name;

/**
 * Row with button
 */
$data = $tabs ? array('unique_name_id' => $unique_name_id, 'tabs' => true) : array('unique_name_id' => $unique_name_id, 'tabs' => false);

echo '<div class="input-field col s12">';
    echo '<label class="required" for="BlogArticle_subtitle">Subtitle</label>';
    echo '<textarea class="mceEditor" id="'.$unique_name_textarea.'"></textarea>';
echo '</div>';


echo $this->inputRow(TbInput::TYPE_TEXTAREA, $model, $attribute, $data, $htmlOptions);


/**
 * Hidden modal window
 */

/*echo '<div id="'.$unique_name.'" class="modal">';
    echo '<div class="modal-content">';
        echo '<h4>WYSIWYG Editor &raquo;'.$model->getAttributeLabel('description').'</h4>';
        echo '<label><textarea class="mceEditor" id="'.$unique_name_textarea.'"></textarea></label>';
    echo '</div>';
    echo '<div class="modal-footer">';
        echo CHtml::link(
            'Submit',
            '#!',
            array('class' => 'btn-primary modal-action modal-close waves-effect waves-green btn-flat'));
        echo CHtml::link(
            'Close',
            '#!',
            array('class' => 'modal-action modal-close waves-effect waves-green btn-flat'));
    echo '</div>';
echo '</div>';*/

Yii::app()->clientScript->registerScript('tinyMceVars'.$active_id,"
        var unique_name".$mceCount." = '".$unique_name_id."';
        var unique_name_textarea".$mceCount." = '".$unique_name_textarea."';
        var basic_name_id".$mceCount." = '".$basic_name_id."';
", CClientScript::POS_BEGIN);

Yii::app()->clientScript->registerScript('tinyMceFunctions'.$active_id,"
    // Initialize vars
    // When Modal is Hidden
    $(\"[href='#next']\").on('click', function () {
        var content = tinyMCE.get(unique_name_textarea).getContent();
        $(basic_name_id).html(content);
    });
", CClientScript::POS_END);

Yii::app()->clientScript->registerScript('tinyMceFunctionsOnLoad'.$active_id,"
    tinyMCE.get('".$unique_name_textarea."').setContent($('".$basic_name_id."').val());
", CClientScript::POS_LOAD);