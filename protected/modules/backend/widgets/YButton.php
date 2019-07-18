<?php
/**
 *##  TbButton class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 * @since 0.9.10
 *
 * @author Amr Bedair <amr.bedair@gmail.com>
 * @since v4.0.0 - upgraded to bootstrap 3.1.1
 */
Yii::import('booster.widgets.TbButton');
/**
 * Bootstrap button widget.
 *
 * @see http://getbootstrap.com/css/#buttons
 *
 * @package booster.widgets.forms.buttons
 */
class YButton extends TbButton {
    /**
     *### .createButton()
     *
     * Creates the button element.
     *
     * @return string the created button.
     */
    protected function createButton() {

        switch ($this->buttonType) {
            case self::BUTTON_LINK:
                return CHtml::link($this->label, $this->url, $this->htmlOptions);

            case self::FORM_SUBMIT:
                $this->htmlOptions['type'] = 'submit';
                ob_start();
                echo '<div class="input-field col s12">';

                 echo CHtml::htmlButton($this->label, $this->htmlOptions);



                echo '</div>';
                return ob_get_clean();

            case self::BUTTON_SUBMIT:
                $this->htmlOptions['type'] = 'submit';
                return CHtml::htmlButton($this->label, $this->htmlOptions);

            case self::BUTTON_RESET:
                $this->htmlOptions['type'] = 'reset';
                return CHtml::htmlButton($this->label, $this->htmlOptions);

            case self::BUTTON_SUBMITLINK:
                return CHtml::linkButton($this->label, $this->htmlOptions);

            case self::BUTTON_AJAXLINK:
                return CHtml::ajaxLink($this->label, $this->url, $this->ajaxOptions, $this->htmlOptions);

            case self::BUTTON_AJAXBUTTON:
                $this->ajaxOptions['url'] = $this->url;
                $this->htmlOptions['ajax'] = $this->ajaxOptions;
                return CHtml::htmlButton($this->label, $this->htmlOptions);

            case self::BUTTON_AJAXSUBMIT:
                $this->ajaxOptions['type'] = isset($this->ajaxOptions['type']) ? $this->ajaxOptions['type'] : 'POST';
                $this->ajaxOptions['url'] = $this->url;
                $this->htmlOptions['type'] = 'submit';
                $this->htmlOptions['ajax'] = $this->ajaxOptions;
                return CHtml::htmlButton($this->label, $this->htmlOptions);

            case self::BUTTON_INPUTBUTTON:
                return CHtml::button($this->label, $this->htmlOptions);

            case self::BUTTON_INPUTSUBMIT:
                $this->htmlOptions['type'] = 'submit';
                return CHtml::button($this->label, $this->htmlOptions);

            case self::BUTTON_TOGGLE_RADIO:
                return $this->createToggleButton('radio');

            case self::BUTTON_TOGGLE_CHECKBOX:
                return $this->createToggleButton('checkbox');

            default:
            case self::BUTTON_BUTTON:
                return CHtml::htmlButton($this->label, $this->htmlOptions);
        }
    }
}