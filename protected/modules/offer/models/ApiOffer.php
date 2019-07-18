<?php

Yii::import('offer.models.ApiOperationFunctions');

class ApiOffer extends ApiOperationFunctions
{
    public function getOffers($criteria = false)
    {
        if (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $criteria->scopes = array('active');
        $criteria->with = 'realty';

        $realtyOffers = RealtyOffer::model()->search($criteria);
        return $realtyOffers;
    }

    public function getFavorite()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_ip = :user';
        $criteria->params[':user'] = YHelper::get_client_ip();
        $favorite = Favorite::model()->findAll($criteria);

        $favoriteId = CHtml::listData($favorite, 'offer_id', 'offer_id');
        $favoriteId = array_values($favoriteId);

        $criteria = new CDbCriteria;
        $criteria->scopes = array('active');
        $criteria->addInCondition('t.id', $favoriteId);

        $realtyOffers = RealtyOffer::model()->search($criteria);
        return $realtyOffers;
    }

    public function getOffer($id)
    {
        $offer = RealtyOffer::model()->active()->findByPk($id);
        return $offer;
    }

    public function getFilters()
    {
        $filter = array();

        $districts = CHtml::listData(CityDistrict::model()->findAll(), 'id', 'district_'.Yii::app()->language);
        $districts = array_values($districts);
        array_unshift($districts , Yii::t("MainModule.main", 'Все'));
        $filter['districts'] = $districts;

        $realtyOffer = RealtyOffer::model()->getType();
        $filter['realtyOffer'] = $realtyOffer;

        $realtyType = Realty::model()->getRealtyType();
        unset($realtyType[0]);
        $filter['realtyType'] = $realtyType;

        $areaFilter = $this->getAreaFilter();
        array_unshift($areaFilter , Yii::t("MainModule.main", 'Все'));
        $filter['areaFilter'] = $areaFilter;

        $moneyFilter = $this->getMoneyFilter();
        array_unshift($moneyFilter , Yii::t("MainModule.main", 'Все'));
        $filter['moneyFilter'] = $moneyFilter;

        $roomsFilter = $this->getRoomsFilter();
        array_unshift($roomsFilter , Yii::t("MainModule.main", 'Все'));
        $filter['roomsFilter'] = $roomsFilter;

        return $filter;
    }

    public function getActiveFilter()
    {
        $disableFilter = array();

        $filters = array(
            'districts' => Yii::t("OfferModule.offer", 'Молдова - Кишинёв'),
            'realtyOffer' => Yii::t("OfferModule.offer", 'Аренда'),
            'realtyType' => Yii::t("OfferModule.offer", 'Земельный участок'),
            'areaFilter' => Yii::t("OfferModule.offer", 'ПЛОЩАДЬ - ВСЁ'),
            'moneyFilter' => Yii::t("OfferModule.offer", 'ЦЕНА - ВСЁ'),
        );

        if (isset($_POST['districts'])) {
            $postFilter = $this->getPostValues('districts');
            $district = CityDistrict::model()->findByPk(end($postFilter));
            if ($district) {
                $filters['districts'] = $district->district;
            }
        }

        if (isset($_POST['realtyOffer'])) {
            $postFilter = $this->getPostValues('realtyOffer');

            if ($postFilter) {
                $filters['realtyOffer'] = RealtyOffer::model()->getType(end($postFilter));
            }
        }

        if (isset($_POST['realtyType'])) {
            $postFilter = $this->getPostValues('realtyType');

            if ($postFilter) {
                $filters['realtyType'] = Realty::model()->getRealtyType(end($postFilter));
            }
        }

        if (isset($_POST['areaFilter'])) {
            $postFilter = $this->getPostValues('areaFilter');
            $realtyType = $this->getPostValues('realtyType');

            if (in_array('estate', $realtyType) || in_array('apartments', $realtyType)) {
                $activeFilter = $this->getBetweenRooms($postFilter);
                if (!empty($activeFilter['start']) || !empty($activeFilter['end'])) {
                    $filters['areaFilter'] = $this->formatRoomFilter($activeFilter);
                } else {
                    $filters['areaFilter'] = Yii::t("OfferModule.offer", 'КОМНАТЫ - ВСЁ');
                }
            } else {
                $activeFilter = $this->getBetweenFilter($postFilter);
                if (!empty($activeFilter['start']) || !empty($activeFilter['end'])) {
                    $filters['areaFilter'] = $this->formatFilter($activeFilter, true);
                }
            }

            if (isset($activeFilter['disableFilter'])) {
                $disableFilter['areaFilter'] = $activeFilter['disableFilter'];
            }
        }

        if (isset($_POST['moneyFilter'])) {
            $postFilter = $this->getPostValues('moneyFilter');
            $activeFilter = $this->getBetweenFilter($postFilter);

            if (isset($activeFilter['disableFilter'])) {
                $disableFilter['moneyFilter'] = $activeFilter['disableFilter'];
            }

            if (!empty($activeFilter['start']) || !empty($activeFilter['end'])) {
                $filters['moneyFilter'] = $this->formatFilter($activeFilter);
            }
        }

        if ($disableFilter) {
            $filters['disableFilter'] = $disableFilter;
        }

        return $filters;
    }

    private function getPostValues($name)
    {
        if (isset($_POST[$name])) {
            if(is_array($_POST[$name])){
                $in = array_filter($_POST[$name]);
                return array_values($in);
            }else{
                return ($_POST[$name])?array($_POST[$name]):array();
            }
        }

        return [];
    }

    protected function getRoomsFilter()
    {
        return array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10);
    }
}