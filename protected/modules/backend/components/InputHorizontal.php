<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

Yii::import('booster.widgets.input.TbInputHorizontal');

class InputHorizontal extends TbInputHorizontal
{
    public $options;

    /**
     * Runs the widget.
     */
    public function run($echoDiv = true)
    {
        $class = isset($this->options['groupOptions']['class']) ? $this->options['groupOptions']['class'] : 'input-field col s12';

        if(!$this->data['tabs'])
            echo CHtml::openTag('div', array('class' => $class . ' ' . $this->getContainerCssClass()));

        parent::run(false);

        if(!$this->data['tabs'])
            echo CHtml::closeTag('div');
    }

    protected function getLabel()
    {
        if (isset($this->labelOptions['class']))
            $this->labelOptions['class'] .= ' active';
        else
            $this->labelOptions['class'] = 'active';

       if(isset($this->htmlOptions["required_element"]))
            $this->labelOptions['required'] = $this->htmlOptions["required_element"];
       if(isset($this->htmlOptions["labelOverride"]))
           return CHtml::label($this->htmlOptions["labelOverride"],CHtml::activeId($this->model,$this->attribute),$this->labelOptions);

        return parent::getLabel();
    }

    protected function textField()
    {
        echo $this->getLabel();
        echo $this->getPrepend();
        echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
        echo $this->getAppend();
        echo $this->getError().$this->getHint();
    }

    protected function textArea()
    {
        if (!$this->data['tabs']) echo $this->getLabel();
        echo $this->form->textArea($this->model, $this->attribute, $this->htmlOptions);
        echo $this->getError() . $this->getHint();
    }
}