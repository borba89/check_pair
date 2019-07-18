<?php
class DButtonGroup extends CWidget
{
    private static $count = 0;
    private $_postvalues = null;
    public $name;
    public $buttons;
    public $idSufix = '';
    public $activeFilter = null;

    public function run()
    {
        if ($this->buttons) {
            $i = 0;
            foreach ($this->buttons as $key => $button) {
                $value = '';
                $index = self::$count++;
                $options = array('data-field' => $this->name.$index.$this->idSufix, 'data-value' => $key);

                if (in_array($this->name, array('realtyOffer', 'realtyType')) && count($this->getPostValues()) == 0 && $i == 0) {
                    $options['class'] = 'added default';
                    $value = 0;
                } elseif ($key === 0 && count($this->getPostValues()) == 0) {
                    $options['class'] = 'added default';
                    $value = 0;
                } elseif ($key === 0) {
                    $options['class'] = 'default';
                    $value = 0;
                } elseif ($this->checkInPost($key)) {
                    $options['class'] = 'added';
                    $value = $key;
                }

                echo CHtml::openTag('li');
                echo CHtml::link($button, '#', $options);
                echo CHtml::hiddenField($this->name.'[]', $value, array('id' => $this->name.$index.$this->idSufix));
                echo CHtml::closeTag('li');
                $i++;
            }
        }
    }

    private function checkInPost($value)
    {
        if ($this->getPostValues()) {
            if (in_array($value, $this->getPostValues()) && !in_array($value, $this->disableFilter())) {
                return true;
            }
        }
        return false;
    }

    private function getPostValues()
    {
        if (isset($_POST[$this->name]) && !isset($this->_postvalues[$this->name])) {
            $in = array_values($_POST[$this->name]);
            $this->_postvalues[$this->name] = array_filter($in);
        }

        return $this->_postvalues[$this->name];
    }

    private function disableFilter()
    {
        $disableValues = array();
        if (isset($this->activeFilter['disableFilter'][$this->name])) {
            $in = array_filter($this->activeFilter['disableFilter'][$this->name]);
            $disableValues = array_values($in);
        }

        return $disableValues;
    }
}