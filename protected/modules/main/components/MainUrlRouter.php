<?php

class MainUrlRouter extends CBaseUrlRule
{
    private static $instance;
    private $matches;
    private $trance = false;
	
	
    public $transArray = array(
        /*'объявления-недвижимости' => array('language' => array('ru'), 'link' => 'offer/front'),
        'ads-realty-list' => array('language' => array('en'), 'link' => 'offer/front'),
        'anunturi-imobiliare' => array('language' => array('ro'), 'link' => 'offer/front'),*/
        'услуги-агентство-недвижимости' => array('language' => array('ru'), 'link' => 'info/front'),
        'services-real-estate-agency' => array('language' => array('en'), 'link' => 'info/front'),
        'servicii-agentie-imobiliare' => array('language' => array('ro'), 'link' => 'info/front'),

         'новости-о-недвижимости' => array('language' => array('ru'), 'link' => 'main/blog'),
        'realty-news' => array('language' => array('en'), 'link' => 'main/blog'),
        'noutati-despre-imobiliare' => array('language' => array('ro'), 'link' => 'main/blog'),

        'контакты' => array('language' => array('ru'), 'link' => 'main/default/contact'),
        'contacts' => array('language' => array('en'), 'link' => 'main/default/contact'),
        'contacte' => array('language' => array('ro'), 'link' => 'main/default/contact'),

        'соглашение-пользователя' => array('language' => array('ru'), 'link' => 'main/default/contact'),
        'user-agreements' => array('language' => array('en'), 'link' => 'main/default/contact'),
        'contract-utilizator' => array('language' => array('ro'), 'link' => 'main/default/contact'),

        'недвижимость-продажа' => array('language' => array('ru'), 'link' => 'offer/front/sale'),
        'realty-for-sale' => array('language' => array('en'), 'link' => 'offer/front/sale'),
        'mobilliare-vinzare' => array('language' => array('ro'), 'link' => 'offer/front/sale'),

        'о-нас' => array('language' => array('ru'), 'link' => 'main/default/about'),
        'about-us' => array('language' => array('en'), 'link' => 'main/default/about'),
        'despre-noi' => array('language' => array('ro'), 'link' => 'main/default/about'),

        'недвижимость' => array('language' => array('ru'), 'link' => 'main/realty'),
        'realty' => array('language' => array('en'), 'link' => 'main/realty'),
        'imobiliare' => array('language' => array('ro'), 'link' => 'main/realty'),

        'горячие-предложения' => array('language' => array('ru'), 'link' => 'main/realty/hot'),
        'hot-deals' => array('language' => array('en'), 'link' => 'main/realty/hot'),
        'oferte-fierbinte' => array('language' => array('ro'), 'link' => 'main/realty/hot'),

        'вакансии' => array('language' => array('ru'), 'link' => 'main/default/vacancy'),
        'career' => array('language' => array('en'), 'link' => 'main/default/vacancy'),
        'cariera' => array('language' => array('ro'), 'link' => 'main/default/vacancy'),

        'избранное' => array('language' => array('ru'), 'link' => 'main/realty/favorite'),
        'favorites' => array('language' => array('en'), 'link' => 'main/realty/favorite'),
        'favoritele' => array('language' => array('ro'), 'link' => 'main/realty/favorite'),

    );

    public static function Instance()
    {
        if (self::$instance == null) {
            self::$instance = new MainUrlRouter();
        }

        return self::$instance;
    }

    public function urltrans($pathInfo)
    {
        $this->trance = true;
        $flag = $this->checkUrl($pathInfo);

        if ($flag) {
            return Yii::app()->createUrl($this->getUrl($flag));
        }

        return false;  // не применяем данное правило
    }

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if (isset($route)) {
            //echo CVarDumper::dump($params,10,true);exit;
            return $this->getUrl($route);
        }

        return false;  // не применяем данное правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        $flag = $this->checkUrl($pathInfo);
        //echo CVarDumper::dump($flag,10,true);exit;
        if ($flag) {
            return $flag;
        }

        return false;  // не применяем данное правило
    }

    //========================help functions=====================

    private function checkUrl($pathInfo)
    {
        $flag = false;
        $pathInfo = preg_replace('~^'.Yii::app()->getBaseUrl(true).'/~msiu', '', $pathInfo);
        $pathInfo = trim($pathInfo, "/");
        $pathInfo = urldecode($pathInfo);
        //echo CVarDumper::dump($pathInfo,10,true);exit;

        if (preg_match('~^backend~', $pathInfo)) {
            return $flag;
        }

        if (preg_match('~([а-яА-ЯЁёa-zA-Z0-9_-]+)?$~u', $pathInfo, $this->matches))
        {
            //echo CVarDumper::dump($this->matches,10,true);exit;
            if (isset($this->matches[1])) {
                $language = $this->getNewLanguage();

                //Для пагинации по ajax на //main/realty
                $ajaxPaginationRealtyList = false;
                if (isset($_GET['ajax'])){
                    if ($_GET['ajax'] == 'realty-list'){
                        $ajaxPaginationRealtyList= true;
                    }
                }
                if ( !(isset($_GET['RealtyOffer_page']) || $ajaxPaginationRealtyList) || isset($_GET['Lang'])){
                    $this->trance = true;
                }

                //echo CVarDumper::dump($this->transArray[$this->matches[1]]['language'][0],10,true);exit;
                if ($this->trance && isset($this->transArray[$this->matches[1]]['language'][0])) {
                    $language = $this->transArray[$this->matches[1]]['language'][0];
                }

                $_GET['language'] = $language;
                if (@in_array($language, $this->transArray[$this->matches[1]]['language'])) {
                    $flag = $this->transArray[$this->matches[1]]['link'];
                }
            }
        }
        //echo CVarDumper::dump($flag,10,true);exit;
        return $flag;
    }

    private function getNewLanguage()
    {
        $language = (isset(Yii::app()->user) && isset(Yii::app()->user->language)) ?
            Yii::app()->user->language : Yii::app()->languages->defaultLanguage;

        if (Yii::app()->user->hasState('language')) {
            $language = Yii::app()->user->getState('language');
        } else if (isset(Yii::app()->request->cookies['language'])) {
            $language = Yii::app()->request->cookies['language']->value;
        }

        return $language;
    }

    private function getUrl($route)
    {
        $language = $this->getNewLanguage();
        $result = $this->search('link', $route, $language);
        //echo CVarDumper::dump($result,10,true);exit;
        if(empty($result)) return false;
        return $result;
    }

    public function search($key, $value, $language)
    {
        $result = '';
        if (is_array($this->transArray)) {
            foreach ($this->transArray as $subkey => $subarray) {
                if (isset($subarray[$key]) && $subarray[$key] == $value && in_array($language, $subarray['language'])) {
                    $result = $subkey;
                    break;
                }
            }
        }
        //echo CVarDumper::dump($value,10,true);exit;

        return $result;
    }
		
}
