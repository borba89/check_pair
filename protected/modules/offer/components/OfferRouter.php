<?php

Yii::import('offer.models.RealtyOffer');

class OfferRouter extends CBaseUrlRule
{
    private static $instance;
    private $matches;
    private $trance = false;
    public $transArray = array(
        /*'объявление-недвижимость-детали' => array('language' => array('ru'), 'link' => 'offer/front/single'),
        'ad-realty-details' => array('language' => array('en'), 'link' => 'offer/front/single'),
        'anunturi-imobiliare-detalii' => array('language' => array('ro'), 'link' => 'offer/front/single'),*/
        'объявление-недвижимость-детали' => array('language' => array('ru'), 'link' => 'main/realty/single'),
        'ad-realty-details' => array('language' => array('en'), 'link' => 'main/realty/single'),
        'anunturi-imobiliare-detalii' => array('language' => array('ro'), 'link' => 'main/realty/single'),
    );

    public static function Instance()
    {
        if (self::$instance == null) {
            self::$instance = new OfferRouter();
        }

        return self::$instance;
    }

    public function urltrans($pathInfo)
    {
        $this->trance = true;
        $flag = $this->checkUrl($pathInfo);

        if ($flag && $_GET['id']) {
            return Yii::app()->createUrl($this->getUrl($flag, array('id'=>$_GET['id'])));
        }

        return false;  // не применяем данное правило
    }

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if (isset($route) && isset($params['id'])) {
            return $this->getUrl($route, $params);
        }

        return false;  // не применяем данное правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        $flag = $this->checkUrl($pathInfo);

        if ($flag && $_GET['id']) {
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

        if (preg_match('~^backend~', $pathInfo)) {
            return $flag;
        }

        if (preg_match('~([а-яА-ЯЁёa-zA-Z0-9_-]+)?\-([0-9]+)$~u', $pathInfo, $this->matches))
        {
            if (isset($this->matches[2])) {
                if ($offer = $this->dbExist('RealtyOffer', $this->matches[2])) {
                    $_GET['id'] = $offer;
                }
            }

            if (isset($this->matches[1])) {
                $language = $this->getNewLanguage();

                if ($this->trance) {
                    $language = $this->transArray[$this->matches[1]]['language'][0];
                }

                if (@in_array($language, $this->transArray[$this->matches[1]]['language'])) {
                    $flag = $this->transArray[$this->matches[1]]['link'];
                }
            }
        }

        return $flag;
    }

    private function dbExist($db, $id)
    {
        $model = $db::model()->findByPk($id);

        if ($model) return $model->id;
        else return false;
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

    private function getUrl($route, $params)
    {
        $language = $this->getNewLanguage();
        $result = $this->search('link', $route, $language);
        if(empty($result)) return false;
        return $result.'-'.$params['id'];
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

        return $result;
    }
}
