<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

/**
 * Bootstrap button column widget.
 * Used to set buttons to use Glyphicons instead of the defaults images.
 */

Yii::import('booster.widgets.TbButtonColumn');

class ButtonColumn extends TbButtonColumn
{
    public $viewButtonIcon = 'visibility';//'eye';
    public $updateButtonIcon = 'description';
    public $deleteButtonIcon = 'delete';

    protected function renderButton($id, $button, $row, $data)
    {
        if (isset($button['visible']) && !$this->evaluateExpression($button['visible'], array('row'=>$row, 'data'=>$data)))
            return;

        $label = isset($button['label']) ? $button['label'] : $id;
        $url = isset($button['url']) ? $this->evaluateExpression($button['url'], array('data'=>$data, 'row'=>$row)) : '#';
        $options = isset($button['options']) ? $button['options'] : array();

        if (!isset($options['title']))
            $options['title'] = $label;

        if (!isset($options['rel']))
            $options['rel'] = 'tooltip';

        if (isset($button['icon']))
        {
            /*if (strpos($button['icon'], 'icon') === false)
                $button['icon'] = implode('', explode(' ', $button['icon']));*/

            echo CHtml::link('<i class="material-icons">'.$button['icon'].'</i>', $url, $options);
        }
        else if (isset($button['imageUrl']) && is_string($button['imageUrl']))
            echo CHtml::link(CHtml::image($button['imageUrl'], $label), $url, $options);
        else
            echo CHtml::link($label, $url, $options);
    }
}
