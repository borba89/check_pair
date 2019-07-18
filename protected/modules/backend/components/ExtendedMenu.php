<?php
Yii::import('zii.widgets.CMenu');

class ExtendedMenu extends CMenu
{
    public $menuModel;
    public $activeAddress;

    protected function renderMenu($items)
    {
        if(count($items)) {
            $this->renderMenuRecursive($items);
        }
    }

    protected function renderMenuRecursive($items)
    {
        if ($this->menuModel) {
            $this->registerMenuCss();
            $this->registerMenuJs();
        }

        $count=0;
        $n=count($items);
        foreach($items as $item)
        {
            $count++;
            $options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class=array();
            if($item['active'] && $this->activeCssClass!='')
                $class[]=$this->activeCssClass;
            if($count===1 && $this->firstItemCssClass!==null)
                $class[]=$this->firstItemCssClass;
            if($count===$n && $this->lastItemCssClass!==null)
                $class[]=$this->lastItemCssClass;
            if($this->itemCssClass!==null)
                $class[]=$this->itemCssClass;
            if($class!==array())
            {
                if(empty($options['class']))
                    $options['class']=implode(' ',$class);
                else
                    $options['class'].=' '.implode(' ',$class);
            }


            $menu=$this->renderMenuItem($item);
            if(isset($this->itemTemplate) || isset($item['template']))
            {
                $template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template,array('{menu}'=>$menu));
            }
            else
                echo $menu;

            if(isset($item['items']) && count($item['items']))
            {
                $this->renderMenuRecursive($item['items']);
            }

        }
    }

    protected function renderMenuItem($item)
    {
        if (isset($item['url'])) {
            if(isset($item['linkOptions']['class']))
                $item['linkOptions']['class'] .= 'waves-effect waves-light btn m-b-xs';
            else
                $item['linkOptions']['class'] = 'waves-effect waves-light btn m-b-xs';

            $label = $this->linkLabelWrapper === null ? $item['label'] : '<' . $this->linkLabelWrapper . '>' . $item['label'] . '</' . $this->linkLabelWrapper . '>';
            return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
        } else
            return CHtml::tag('span', isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }

    private function registerMenuCss() {
        if ((isset($this->menuModel->status) &&  $this->menuModel->status == Realty::OPENED)
            || !empty($this->menuModel->is_active)) {
            Yii::app()->clientScript->registerCss('menu-css', '
                #deleteLot, #openLot {
                   display: none;
                }
            ');
        } else {
            Yii::app()->clientScript->registerCss('menu-css', '
                #closeLot, #updateLot {
                   display: none;
                }
            ');
        }
    }

    private function registerMenuJs() {
        Yii::app()->clientScript->registerScript('menu-js', "
            function sendAjax(callback) {
                $.ajax({
                    url: '".$this->activeAddress."',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        callback();
                    }
                });
            }

            $('#closeLot').on('click', function(evt) {
                evt.preventDefault();
                sendAjax(function(){
                    $('#closeLot').hide();
                    $('#deleteLot').css('display', 'inline-block');
                    $('#openLot').css('display', 'inline-block');
                    $('#updateLot').hide();
                });
            });

            $('#openLot').on('click', function(evt) {
                evt.preventDefault();
                sendAjax(function(){
                    $('#openLot').hide();
                    $('#deleteLot').hide();
                    $('#closeLot').css('display', 'inline-block');
                    $('#updateLot').css('display', 'inline-block');
                });
            });
        ", CClientScript::POS_READY);
    }
}