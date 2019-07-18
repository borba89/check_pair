<?php
class Sitemap extends CApplicationComponent
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    protected $items = array();

    /**
     * @param $url
     * @param string $changeFreq
     * @param float $priority
     * @param int $lastmod
     */
    public function addUrl($url, $changeFreq=self::DAILY, $priority=0.5, $lastMod=0)
    {
        $host = Yii::app()->request->hostInfo;
        $item = array(
            'loc' => $host . $url,
            'changefreq' => $changeFreq,
            'priority' => $priority
        );
        if ($lastMod)
            $item['lastmod'] = $this->dateToW3C($lastMod);

        $this->items[] = $item;
    }

    /**
     * @param CActiveRecord[] $models
     * @param string $changeFreq
     * @param float $priority
     */
    public function addModels($models, $changeFreq=self::DAILY, $priority=0.5)
    {
        $host = Yii::app()->request->hostInfo;
        foreach ($models as $model)
        {
            $item = array(
                'loc' => $host . $model->getUrl(Yii::app()->languages->defaultLanguage),
                'changefreq' => $changeFreq,
                'priority' => $priority,
            );

            if(!empty(Yii::app()->languages->languages)) {
                foreach(Yii::app()->languages->languages as $language)
                    $item['xhtml:link'][$language] = array('rel' => 'alternate', 'hreflang' => $language, 'href' => $host . $model->getUrl($language));
            }

            if ($model->hasAttribute('updated'))
                $item['lastmod'] = $this->dateToW3C($model->updated);

            $this->items[] = $item;
        }
    }

    /**
     * @return string XML code
     */
    public function render()
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:xhtml','http://www.w3.org/1999/xhtml');
        foreach($this->items as $item) {
            $url = $dom->createElement('url');

            foreach ($item as $key=>$value) {
                if(is_array($value)) {
                    if($value[Yii::app()->language]) {
                        foreach(Yii::app()->languages->languages as $lang) {
                            $elem = $dom->createElement($key);
                            foreach($value[$lang] as $keyLang => $valueLang)
                                $elem->setAttribute($keyLang, $valueLang);
                        }
                        $url->appendChild($elem);
                    }
                } else {
                    $elem = $dom->createElement($key);
                    $elem->appendChild($dom->createTextNode($value));
                    $url->appendChild($elem);
                }
            }

            $urlset->appendChild($url);
        }
        $dom->appendChild($urlset);

        return $dom->saveXML();
    }

    protected function dateToW3C($date)
    {
        if (is_int($date))
            return date(DATE_W3C, $date);
        else
            return date(DATE_W3C, strtotime($date));
    }
}