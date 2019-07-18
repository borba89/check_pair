<?php
/**
 * SeoHead class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package chemezov.yii-seo.widgets
 */

class SeoHead extends CWidget
{
    /**
     * @property array the page http-equivs.
     */
    public $httpEquivs = array();
    /**
     * @property string the page meta title.
     */
    public $defaultTitle;
    /**
     * @property string the page meta description.
     */
    public $defaultDescription;
    /**
     * @property string the page meta keywords.
     */
    public $defaultKeywords;
    /**
     * @property string the page meta og image.
     */
    public $ogImage;
    /**
     * @property array the page meta properties.
     */
    public $defaultProperties = array();

    public $titleSeparator = ' | ';

    protected $_title;
    protected $_description;
    protected $_keywords;
    protected $_ogImage;
    protected $_properties = array();
    protected $_canonical;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        /* @var SeoBehavior $behavior */
        $behavior = $this->controller->asa('seo');

        if ($behavior !== null && $behavior->title !== null)
            $this->_title = $behavior->title;
        elseif (!empty($this->controller->pageTitle))
            $this->_title = $this->controller->pageTitle;
        else if ($this->defaultTitle !== null)
            $this->_title = $this->defaultTitle;

        if ($behavior !== null && $behavior->metaDescription !== null)
            $this->_description = $behavior->metaDescription;
        else if ($this->defaultDescription !== null)
            $this->_description = $this->defaultDescription;

        if ($behavior !== null && $behavior->metaKeywords !== null)
            $this->_keywords = $behavior->metaKeywords;
        else if ($this->defaultKeywords !== null)
            $this->_keywords = $this->defaultKeywords;

        if ($behavior !== null && $behavior->ogImage !== null)
            $this->_ogImage = $behavior->ogImage;
        else if ($this->ogImage !== null)
            $this->_ogImage = $this->ogImage;

        if ($behavior !== null)
            $this->_properties = array_merge($behavior->metaProperties, $this->defaultProperties);
        else
            $this->_properties = $this->defaultProperties;

        if ($behavior !== null && $behavior->canonical !== null)
            $this->_canonical = $behavior->canonical;
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->renderContent();
    }

    /**
     * Renders the widget content.
     */
    protected function renderContent()
    {
        foreach ($this->httpEquivs as $name => $content)
            echo CHtml::metaTag($content, null, $name);

        if ($this->_title !== null) {
            echo CHtml::tag('title', array(), is_array($this->_title) ? implode($this->titleSeparator, $this->_title) : $this->_title);
            Yii::app()->clientScript->registerMetaTag($this->_title, '', '', array('property' =>  "og:title"));
        }

        if ($this->_description !== null) {
            echo CHtml::metaTag($this->_description, 'description');
            Yii::app()->clientScript->registerMetaTag($this->_description, '', '', array('property' =>  "og:description"));
        }

        if ($this->_keywords !== null)
            echo CHtml::metaTag($this->_keywords, 'keywords');

        foreach ($this->_properties as $name => $content)
            echo CHtml::tag('meta', array('property' => $name, 'content' => $content));

        if ($this->_canonical !== null) {
            echo CHtml::linkTag('canonical', null, $this->_canonical);
            Yii::app()->clientScript->registerMetaTag($this->_canonical, '', '', array('property' =>  "og:url"));
        }

        if ($this->_ogImage !== null)
            Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl($this->_ogImage), '', '', array('property' =>  "og:image"));
    }
}
