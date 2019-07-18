<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

Yii::import('booster.widgets.TbActiveForm');
Yii::import('booster.widgets.input.TbInput');


class ActiveForm extends TbActiveForm
{
    private static $mceCount = 0;
    const INPUT_HORIZONTAL = 'backend.components.InputHorizontal';

    /**
     * Tinymce field render and connect the script
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function tinyMceGroup($model, $attribute, $htmlOptions = array(), $tabs = false, $button_position = 'top')
    {
        if (isset($htmlOptions['name']))
            $active_id = CHtml::getIdByName($htmlOptions['name']);
        else
            $active_id = CHtml::activeId($model, $attribute);

        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/widgets/wisiwyg/tinymce/js/tinymce/tinymce.min.js",
            CClientScript::POS_END);

        $directory_path = urlencode(Yii::getPathOfAlias('webroot')).'/images'; //full path to directory of files
        $directory_url = urlencode(Yii::app()->createAbsoluteUrl("images"));

        Yii::app()->clientScript->registerScript('tinymce_initialize_details', 'tinymce.init({
                    toolbar: "link | image",
                    file_browser_callback: elFinderBrowser,
                    mode : "specific_textareas",
                    editor_selector : "mceEditor",
                    plugins: [
                    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
                    ],

                    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
                    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

                    relative_urls : false,
                    remove_script_host : false,
                    convert_urls : true,

                    width:"100%",
                    height:"400px",
                    language : "en",
                    pagebreak_separator : "<!-- columnbreak -->",
                    template_templates:[
                        {
                            title:"Product Details",
                            src: "'.$this->controller->module->assetsUrl.'/js/tinymce/js/tinymce/plugins/template/product_details.htm",
                            description:"Product Details"
                        }
                    ],
                    templates: "/protected/modules/backend/components/gettemplate.php",
                    forced_root_block : "",
                    extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]",
                });

                function elFinderBrowser (field_name, url, type, win) {
                    tinymce.activeEditor.windowManager.open({
                        file: "' . $this->controller->module->assetsUrl . '/widgets/wisiwyg/elfinder-2.0/elfinder.php?directory_path=' . $directory_path . '&directory_url=' . $directory_url . '",// use an absolute path!
                        title: "elFinder 2.0",
                        width: 900,
                        height: 450,
                        resizable: "yes"
                        }, {
                            setUrl: function (url) {
                              win.document.getElementById(field_name).value = url;
                        }
                    });
                    return false;
                }
            ');

        return $this->render("tmc", array('model' => $model, 'attribute' => $attribute, 'htmlOptions' => $htmlOptions, 'active_id' => $active_id, 'button_position' => $button_position, 'tabs' => $tabs, 'mceCount' => self::$mceCount++), true);
    }

    /**
     * File field with attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function fileField($model, $attribute, $htmlOptions = array())
    {
        $size = null;
        if(isset($htmlOptions['previewSize']))
            $size = $htmlOptions['previewSize'];
        unset($htmlOptions['previewSize']);

        return $this->render("file_field",array("model"=>$model,"attribute"=>$attribute,'size'=>$size));
    }

    public function tagsFieldGroup($model, $attribute, $htmlOptions = array())
    {
        return $this->render("tags",array("model"=>$model,"attribute"=>$attribute,'htmlOptions'=>$htmlOptions));
    }

    /**
     * Mask Field patterns a,9,*
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @param string $mask
     * @return string
     */
    public function maskField($model, $attribute, $options = array(), $mask = "AA-999-A999", $maskoption = "")
    {
        $this->initOptions($options);
        $widgetOptions = $options['widgetOptions'];

        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/plugins/jquery-inputmask/jquery.inputmask.bundle.js",
            CClientScript::POS_END);

        $append = '<script>
        $().ready(function(){
            $("#' . CHtml::activeId($model, $attribute) . '").inputmask("' . $mask . '", {'.$maskoption.'});
        });
        </script>';
        return $this->inputRow(TbInput::TYPE_TEXT, $model, $attribute, null, $widgetOptions['htmlOptions'], $options) . $append;
    }

    public function checkboxGroup($model, $attribute, $options = array()) {
        $this->initOptions($options);

        if ($this->type == self::TYPE_INLINE)
            self::addCssClass($options['labelOptions'], 'inline');

        $options['widgetOptions']['htmlOptions']['class'] = 'custom-checkbox';

        $field = $this->checkbox($model, $attribute, $options['widgetOptions']['htmlOptions']);
        if ((!array_key_exists('uncheckValue', $options['widgetOptions']) || isset($options['widgetOptions']['uncheckValue'])) && preg_match('/\<input.*?type="hidden".*?\>/', $field, $matches)) {
            $hiddenField = $matches[0];
            $field = str_replace($hiddenField, '', $field);
        }

        ob_start();
        echo '<p class="p-v-xs">';
        if (isset($hiddenField)) echo $hiddenField;
        echo $field;
        echo CHtml::tag('label', $options['labelOptions'], false, false);
        echo CHtml::closeTag('label');
        echo '</p>';
        $fieldData = ob_get_clean();

        if (!isset($options['groupOptions']['class'])) {
            $options['groupOptions']['class'] = '';
        }
        $options['groupOptions']['class'] .= ' m6';
        return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function uploadifyRow($model,$attribute,$relation, $htmlOptions = array()){


        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/widgets/uploadify/jquery.uploadifive.min.js",
            CClientScript::POS_END
        );

        Yii::app()->clientScript->registerCssFile(
            $this->controller->module->assetsUrl . "/widgets/uploadify/uploadifive.css"
        );

        return $this->render("uploadifyRow/_uploadify", array('model' => $model, 'attribute' => $attribute,
            'htmlOptions' => $htmlOptions,'relation' => $relation));
    }

    /**
     * Dropdown with jquery plugin chosen
     * @param $model
     * @param $attribute
     * @param array $data
     * @param array $htmlOptions
     * @return string
     */

    public function dropDownListGroup($model, $attribute, $data = array(), $options = array()) {
        $this->initOptions($options, true);
        $widgetOptions = $options['widgetOptions'];

        // if(!isset($widgetOptions['data']))
        // throw new CException('$options["widgetOptions"]["data"] must exist');

        $this->addCssClass($widgetOptions['htmlOptions'], 'form-control');

        $fieldData = array(array($this, 'dropDownList'), array($model, $attribute, $data, $widgetOptions['htmlOptions']));

        if (!isset($options['groupOptions']['class'])) {
            $options['groupOptions']['class'] = ' m6';
        }

        return $this->customFieldGroupInternal($fieldData, $model, $attribute, $options);
    }

    /**
     * Dropdown with jquery plugin chosen
     * @param $model
     * @param $attribute
     * @param array $data
     * @param array $htmlOptions
     * @return string
     */

    public function dropDownListChosenRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/chosen/chosen.jquery.min.js",
            CClientScript::POS_END);

        $name = CHtml::activeId($model, $attribute);
        $output = "<script>$().ready(function(){
            $(\"#" . $name . "\").chosen();
        });
        </script>";
        return $this->inputRow(TbInput::TYPE_DROPDOWN, $model, $attribute, $data, $htmlOptions) . $output;
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function dateFieldRow($model, $attribute, $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/datepicker/bootstrap-datepicker.js",
            CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(
            $this->controller->module->assetsUrl . '/lib/datepicker/datepicker.css'
        );

        $htmlOptions = array_merge(array('readonly'=>true,'hint'=>'Click to select date'), $htmlOptions);

        return $this->render('date_field',array('model'=>$model,'attribute'=>$attribute,'htmlOptions'=>$htmlOptions));
    }

    /**
     * Overriding method textFieldGroup for label attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */

    public function textFieldGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $widgetOptions = $options['widgetOptions'];

        $this->addCssClass($widgetOptions['htmlOptions'], 'form-control');
        return $this->inputRow(TbInput::TYPE_TEXT, $model, $attribute, null, $widgetOptions['htmlOptions'], $options);
    }

    /**
     * @param string $type
     * @param CModel $model
     * @param string $attribute
     * @param null $data
     * @param array $htmlOptions
     * @return string
     */
    public function inputRow($type, $model, $attribute, $data = null, $htmlOptions = array(), $options = array())
    {
        ob_start();
        Yii::app()->controller->widget($this->getInputClassName(), array(
            'type' => $type,
            'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data,
            'options' => $options,
            'htmlOptions' => $htmlOptions,
        ));
        return ob_get_clean();
    }

    /**
     * Returns the input widget class name suitable for the form.
     * @return string the class name
     */
    protected function getInputClassName()
    {
        if (isset($this->input))
            return $this->input;
        else {
            switch ($this->type) {
                case self::TYPE_HORIZONTAL:
                    return self::INPUT_HORIZONTAL;
                    break;

                case self::TYPE_INLINE:
                    return self::INPUT_INLINE;
                    break;

                case self::TYPE_VERTICAL:
                default:
                    return self::INPUT_HORIZONTAL;
                    break;
            }
        }
    }

    public function dropDownSelect2Group($model, $attribute, $select_options = array(), $htmlOptions = array()){
        $options = array('width' => '100%');

        if(!empty($htmlOptions['placeholder'])) {
            $options = CMap::mergeArray($options, array('placeholder' => $htmlOptions['placeholder']));
            unset($htmlOptions['placeholder']);
        }

        return $this->render("select2", array("model"=>$model, "attribute"=>$attribute, "select_options"=>$select_options, "options" => $options, 'htmlOptions'=>$htmlOptions));
    }
}