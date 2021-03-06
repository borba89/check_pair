<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 3/18/13
 * Time: 11:08 AM
 * To change this template use File | Settings | File Templates.
 */
Yii::import("zii.widgets.CBreadcrumbs");
class Breadcrumbs extends CBreadcrumbs
{
    public function run()
    {
        $this->separator = '';
        $this->tagName='ul';
        $this->htmlOptions = array('class'=>'breadcrumbs');
        $this->inactiveLinkTemplate = '<li>{label}</li>';
        $this->activeLinkTemplate = '<li>'.CHtml::link("{label}", "{url}").'</li>';

        if (empty($this->links))
            return;


        echo CHtml::openTag($this->tagName, $this->htmlOptions) . "\n";
        $links = array();
        if ($this->homeLink === null)
            $links[] = '<li>'.CHtml::link(Yii::t('zii', 'Home'), Yii::app()->homeUrl, array("class" => "breadcrumbHome")).'</li>';
        elseif ($this->homeLink !== false)
            $links[] = $this->homeLink;
        foreach ($this->links as $label => $url) {
            if (is_string($label) || is_array($url))
                $links[] = strtr($this->activeLinkTemplate, array(
                    '{url}' => CHtml::normalizeUrl($url),
                    '{label}' => $this->encodeLabel ? CHtml::encode($label) : $label,
                ));
            else
                $links[] = str_replace('{label}', $this->encodeLabel ? CHtml::encode($url) : $url, $this->inactiveLinkTemplate);
        }
        echo implode($this->separator, $links);
        echo CHtml::closeTag($this->tagName);
    }

}
