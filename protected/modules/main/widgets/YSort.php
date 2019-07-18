<?php
class YSort extends CSort
{
    public function link($attribute,$label=null,$htmlOptions=array())
    {
        if($label===null)
            $label=$this->resolveLabel($attribute);
        if(($definition=$this->resolveAttribute($attribute))===false)
            return $label;
        $directions=$this->getDirections();
        if(isset($directions[$attribute]))
        {
            $class=$directions[$attribute] ? 'desc' : 'asc';
            if(isset($htmlOptions['class']))
                $htmlOptions['class'].=' '.$class;
            else
                $htmlOptions['class']=$class;
            $descending=!$directions[$attribute];
            unset($directions[$attribute]);
        }
        elseif(is_array($definition) && isset($definition['default']))
            $descending=$definition['default']==='desc';
        else
            $descending=false;

        if($this->multiSort)
            $directions=array_merge(array($attribute=>$descending),$directions);
        else
            $directions=array($attribute=>$descending);

        $url=$this->createUrl(Yii::app()->getController(),$directions);

        $icon = $descending ? '<em aria-hidden="true" class="fa fa-angle-up pr-0_2em"></em> '
            : '<em aria-hidden="true" class="fa fa-angle-down pr-0_2em"></em> ';

        return $this->createLink($attribute,$icon.$label,$url,$htmlOptions);
    }
}