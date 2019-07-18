<?php

Yii::import('offer.models.ApiOperationFunctions');

class CbApiOffer extends ApiOperationFunctions
{
    public function __construct()
    {
        $keys = array_keys($this->getExtendsFilters());
        foreach ($keys as $key) {
            Yii::app()->session[$key] = null;
        }
    }

    /**
     * Возвращает активные объявления вместе с объектами недвижимости
     * @param bool $criteria
     * @return CActiveDataProvider
     */
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

    public function getOffersHot($criteria = false)
    {
        if (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $criteria->scopes = array('active');
        $criteria->with = 'realty';
        $criteria->order = 'views_' . Yii::app()->language . ' DESC';

        $realtyOffers = RealtyOffer::model()->search($criteria);
        return $realtyOffers;
    }

    public function getExtendOffers($criteria = false)
    {
        if (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $criteria->scopes = array('active');
        $criteria->with = 'realty';

        $realtyOffers = RealtyOffer::model()->extendSearch($criteria);
        return $realtyOffers;
    }

    public function getExtendOffersHot($criteria = false)
    {
        if (!$criteria) {
            $criteria = new CDbCriteria;
        }

        $criteria->scopes = array('active');
        $criteria->with = 'realty';
        $criteria->order = 'views_' . Yii::app()->language . ' DESC';

        $realtyOffers = RealtyOffer::model()->extendSearch($criteria);
        return $realtyOffers;
    }

    /**
     * Возвращает избранныеобъявления
     * @return CActiveDataProvider
     */
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

    /**
     * Возвращает активное объявление по его id
     * @param $id
     * @return mixed
     */
    public function getOffer($id)
    {
        $offer = RealtyOffer::model()->active()->findByPk($id);
        return $offer;
    }

    /**
     * Возвращает набор фильтров
     * @return array
     */
    public function getFilters($cityId = null)
    {
        $filter = array();

        if (!empty($cityId)) {

            //For nice-select
            $districtsCity = CityDistrict::model()->findAll('city_id=:city_id AND suburb=0', [':city_id' => $cityId]);
            $districtsCity1 = CHtml::listData($districtsCity, 'id', 'district_' . Yii::app()->language);
            $city = City::model()->findByPk($cityId);
            $districtsCity = [
                0 => Yii::t("MainModule.main", $city->city_name_ru),
                1 => $districtsCity1,
            ];
            $districtsSuburb = CityDistrict::model()->findAll('city_id=:city_id AND suburb=1', [':city_id' => $cityId]);
            $districtsSuburb1 = CHtml::listData($districtsSuburb, 'id', 'district_' . Yii::app()->language);
            $districtsSuburb = [
                0 => Yii::t("MainModule.main", 'Пригород'),
                1 => $districtsSuburb1,
            ];
            $districts = [
                6184260 => Yii::t("MainModule.main", $city->city_name_ru),
                6184261 => $districtsCity1,
                6184270 => Yii::t("MainModule.main", 'Пригород'),
                6184271 => $districtsSuburb1,
            ];

//            $districts = array_merge($districtsCity, $districtsSuburb);
        } else {
            $districts = CityDistrict::model()->findAll();
            $districts = CHtml::listData($districts, 'id', 'district_' . Yii::app()->language);
            $districts = array_values($districts);
            array_unshift($districts, Yii::t("MainModule.main", 'Все'));
        }

        $filter['districts'] = $districts;

            //for select-2
//            $districtsCity = CityDistrict::model()->findAll('city_id=:city_id AND suburb=0', [':city_id' => $cityId]);
//
//            $districtsCity1 = array_map(function ($item) {
//                return [
//                    'id' => $item['id'],
//                    'text' => $item['district_' . Yii::app()->language],
//                ];
//            }, $districtsCity);
//            $city = City::model()->findByPk($cityId);
//            $districtsCity = [
//                'text' => Yii::t("MainModule.main", $city->city_name_ru),
//                'children' => $districtsCity1,
//            ];
//            $districtsSuburb = CityDistrict::model()->findAll('city_id=:city_id AND suburb=1', [':city_id' => $cityId]);
//            $districtsSuburb1 = array_map(function ($item) {
//                return [
//                    'id' => $item['id'],
//                    'text' => $item['district_' . Yii::app()->language],
//                ];
//            }, $districtsSuburb);
//            $districtsSuburb = [
//                'text' => Yii::t("MainModule.main", 'Пригород'),
//                'children' => $districtsSuburb1,
//            ];
//            $districts = [$districtsCity, $districtsSuburb];
//        } else {
//            $districts = CityDistrict::model()->findAll();
//            $districts = CHtml::listData($districts, 'id', 'district_' . Yii::app()->language);
//            $districts = array_values($districts);
//            array_unshift($districts, Yii::t("MainModule.main", 'Все'));
//        }
//
//        $filter['districts'] = $districts;

        /**
         * Тип предложения
         */
        $realtyOffer = RealtyOffer::model()->getType();
        array_unshift($realtyOffer, Yii::t("MainModule.main", 'Тип предложения'));
        $filter['realtyOffer'] = $realtyOffer;

        /**
         * Тип недвижимости
         */
        $realtyType = Realty::model()->getRealtyType();
        unset($realtyType[0]);
        array_unshift($realtyType, Yii::t("MainModule.main", 'Тип недвижимости'));
        $filter['realtyType'] = $realtyType;

        /**
         * Площадь
         */
        $areaFilter = $this->getAreaFilter();
        array_unshift($areaFilter, Yii::t("MainModule.main", 'Площадь участка'));
        $filter['areaFilter'] = $areaFilter;

        /**
         * Фильтр - метраж
         */
        $squareFilter = $this->getSquareFilter();
        array_unshift($squareFilter, Yii::t("MainModule.main", 'Метраж'));
        $filter['squareFilter'] = $squareFilter;

        /**
         * Цена
         */
        $moneyFilter = $this->getMoneyFilter();
        array_unshift($moneyFilter, Yii::t("MainModule.main", 'Цена'));
        $filter['moneyFilter'] = $moneyFilter;

        /**
         * Количество комнат
         */
        $roomsFilter = $this->getRoomsFilter();
        array_unshift($roomsFilter, Yii::t("MainModule.main", 'Количество комнат'));
        $filter['roomsFilter'] = $roomsFilter;

        /**
         * Фильтр - этаж
         */
        $floorFilter = $this->getFloors();
        array_unshift($floorFilter, Yii::t("MainModule.main", 'Этаж'));
        $filter['floorFilter'] = $floorFilter;

        /**
         * Фильтр - Жилой фонд
         */
        $housingStock = $this->getHousingStock();
        array_unshift($housingStock, Yii::t("MainModule.main", 'Жилой фонд'));
        $filter['housingStock'] = $housingStock;


        return $filter;
    }

    public function getExtendsFilters($cityId = null)
    {
        $filter = array();

        if (!empty($cityId)) {
//            $districtsCity = CityDistrict::model()->findAll('city_id=:city_id AND suburb=0', [':city_id' => $cityId]);
//            $districtsCity = CHtml::listData($districtsCity, 'id', 'district_' . Yii::app()->language);
//            $city = City::model()->findByPk($cityId);
//            $districtsCity = array_values($districtsCity);
//            $districtsCity = [
//                0 => $districtsCity
//            ];
//            array_unshift($districtsCity, Yii::t("MainModule.main", $city->city_name_UTF8));
//
//            $districtsSuburb = CityDistrict::model()->findAll('city_id=:city_id AND suburb=1', [':city_id' => $cityId]);
//            $districtsSuburb = CHtml::listData($districtsSuburb, 'id', 'district_' . Yii::app()->language);
//            $districtsSuburb = array_values($districtsSuburb);
//            $districtsSuburb = [
//                1 => $districtsSuburb
//            ];
//            array_unshift($districtsSuburb, Yii::t("MainModule.main", 'Пригород'));
//
//            $districts = array_merge($districtsCity, $districtsSuburb);

            $districtsCity = CityDistrict::model()->findAll('city_id=:city_id AND suburb=0', [':city_id' => $cityId]);
            $districtsCity1 = CHtml::listData($districtsCity, 'id', 'district_' . Yii::app()->language);
            $city = City::model()->findByPk($cityId);
            $districtsCity = [
                0 => Yii::t("MainModule.main", $city->city_name_ru),
                1 => $districtsCity1,
            ];
            $districtsSuburb = CityDistrict::model()->findAll('city_id=:city_id AND suburb=1', [':city_id' => $cityId]);
            $districtsSuburb1 = CHtml::listData($districtsSuburb, 'id', 'district_' . Yii::app()->language);
            $districtsSuburb = [
                0 => Yii::t("MainModule.main", 'Пригород'),
                1 => $districtsSuburb1,
            ];
            $districts = [
                6184260 => Yii::t("MainModule.main", $city->city_name_ru),
                6184261 => $districtsCity1,
                6184270 => Yii::t("MainModule.main", 'Пригород'),
                6184271 => $districtsSuburb1,
            ];
//            $districts = array_merge($districtsCity, $districtsSuburb);
        } else {
            $districts = CHtml::listData(CityDistrict::model()->findAll(), 'id', 'district_' . Yii::app()->language);
            $districts = array_values($districts);
            array_unshift($districts, Yii::t("MainModule.main", 'Все'));
        }
        $filter['districts'] = $districts;

        /**
         * Тип предложения
         */
        $realtyOffer = RealtyOffer::model()->getType();
        array_unshift($realtyOffer, Yii::t("MainModule.main", 'Тип предложения'));
        $filter['realtyOffer'] = $realtyOffer;

        /**
         * Тип недвижимости
         */
        $realtyType = Realty::model()->getRealtyType();
        unset($realtyType[0]);
        array_unshift($realtyType, Yii::t("MainModule.main", 'Тип недвижимости'));
        $filter['realtyType'] = $realtyType;

        /**
         * Площадь
         */
        $areaFilter = $this->getAreaFilter();
        array_unshift($areaFilter, Yii::t("MainModule.main", 'Площадь участка'));
        $filter['areaFilter'] = $areaFilter;

        /**
         * Цена
         */
        $moneyFilter = $this->getMoneyFilter();
        array_unshift($moneyFilter, Yii::t("MainModule.main", 'Цена'));
        $filter['moneyFilter'] = $moneyFilter;

        /**
         * Мин. цена
         */
        $moneyMinFilter = $this->getMinMoneyFilter();
        //array_unshift($moneyMinFilter , Yii::t("MainModule.main", 'Все'));
        $filter['moneyMinFilter'] = $moneyMinFilter;

        /**
         * Макс. цена
         */
        $moneyMaxFilter = $this->getMaxMoneyFilter();
        array_unshift($moneyMaxFilter , Yii::t("MainModule.main", 'Макс. цена - всё'));
        $filter['moneyMaxFilter'] = $moneyMaxFilter;

        /**
         * Количество комнат
         */
        $roomsFilter = $this->getRoomsFilter();
        array_unshift($roomsFilter, Yii::t("MainModule.main", 'Количество комнат'));
        $filter['roomsFilter'] = $roomsFilter;

        /**
         * Фильтр - этаж
         */
        $floorFilter = $this->getFloors();
        array_unshift($floorFilter, Yii::t("MainModule.main", 'Этаж'));
        $filter['floorFilter'] = $floorFilter;

        /**
         * Фильтр - количество этажей
         */
        $numFloorFilter = $this->getBedrooms();
        array_unshift($numFloorFilter, Yii::t("MainModule.main", 'Количество спален'));
        $filter['bedroomsFilter'] = $numFloorFilter;

        /**
         * Фильтр - количество этажей
         */
        $numFloorFilter = $this->getNumFloors();
        array_unshift($numFloorFilter, Yii::t("MainModule.main", 'Этажей в доме'));
        $filter['numFloorFilter'] = $numFloorFilter;

        /**
         * Фильтр - Жилой фонд
         */
        $housingStock = $this->getHousingStock();
        array_unshift($housingStock, Yii::t("MainModule.main", 'Жилой фонд'));
        $filter['housingStock'] = $housingStock;

        /**
         * Фильтр - состояние жилиых помещений
         */
        $conditionFilter = RealtyDetailedDescription::model()->getSpaseConditions();
        array_unshift($conditionFilter, Yii::t("MainModule.main", 'Состояние помещений'));
        $filter['conditionFilter'] = $conditionFilter;

        /**
         * Фильтр - метраж
         */
        $squareFilter = $this->getSquareFilter();
        array_unshift($squareFilter, Yii::t("MainModule.main", 'Метраж'));
        $filter['squareFilter'] = $squareFilter;

        /**
         * Фильтр - типы площадей коммерческой недвижимости.
         */
        $commercialFilter = RealtyDetailedDescription::model()->getCommercialTypes();
        array_unshift($commercialFilter, Yii::t("MainModule.main", 'Назначение площади'));
        $filter['commercialFilter'] = $commercialFilter;

        /**
         * Фильтр - типы готового бизнеса
         */
        $businessType = RealtyDetailedDescription::model()->getSubtypes();
        array_unshift($businessType, Yii::t("MainModule.main", 'Все'));
        $filter['businessType'] = $businessType;

        /**
         * Фильтр - Планировка
         */
        $projectType = BuildingProject::getAllProjectTypes();
        array_unshift($projectType, Yii::t("MainModule.main", 'Планировка'));
        $filter['projectType'] = $projectType;

        /**
         * Фильтр - назначение земли(для типа недвижимости Земельный участок)
         */
        $purposeLand = RealtyDetailedDescription::model()->getLandTypes();
        array_unshift($purposeLand, Yii::t("MainModule.main", 'Назначение участка'));
        $filter['purposeLand'] = $purposeLand;

        return $filter;
    }

    /**
     * Что то возвращает
     * @return array
     */
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


    /**
     * Количество комнат
     * Возвращает массив для выпадающего списка
     * @return array
     */
    public function getRoomsFilter()
    {
        $out = array();
        for ($i = 1; $i <= 10; $i++) {
            $out[$i] = Yii::t("RealtyModule.realty", 'Комнаты').' - '. $i;
        }
        return $out;
    }

    /**
     * Этажи
     * Возвращает массив для выпадающего списка
     * @return array
     */
    public function getFloors()
    {
        $out = array();
        for ($i = 1; $i <= 30; $i++) {
            $out[$i] = Yii::t("RealtyModule.realty", 'Этаж').' - '. $i;
        }
        return $out;
    }

    public function getNumFloors()
    {
        $out = array();
        for ($i = 1; $i <= 30; $i++) {
            $out[$i] = Yii::t("RealtyModule.realty", 'Этажей в доме').' - '. $i;
        }
        return $out;
    }

    /**
     * Спальни
     * Возвращает массив для выпадающего списка
     * @return array
     */
    public function getBedrooms()
    {
        $out = array();
        for ($i = 1; $i <= 10; $i++) {
            $out[$i] = Yii::t("RealtyModule.realty",
                '{n} спальня|{n} спальни|{n} спален',
                array($i, '{n}' => $i)
            );
        }
        return $out;
    }

    /**
     * Фильтр Жилой фонд
     * @return array
     */
    public function getHousingStock()
    {
        return array(
            '0' => Yii::t("RealtyModule.realty", 'Вторичка'),
            '1' => Yii::t("RealtyModule.realty", 'Новострой'),
        );
    }

    /**
     * Возвращает значения для критерия in
     * @param $name
     * @return array
     */
    private function getPostValues($name)
    {
        if (isset($_POST[$name])) {
            if (is_array($_POST[$name])) {
                $in = array_filter($_POST[$name]);
                return array_values($in);
            } else {
                return ($_POST[$name]) ? array($_POST[$name]) : array();
            }
        }

        return [];
    }

    public function getCookiesFilterValues() {
        $selected=[];
        $sessKeys = Yii::app()->session->getKeys();
        foreach ($sessKeys as $sessKey) {
            $selected[$sessKey] =  Yii::app()->request->cookies[$sessKey]?Yii::app()->request->cookies[$sessKey]->value:null;
        }
        return $selected;
    }

    public function clearCookiesFilterValues() {
        $sessKeys = Yii::app()->session->getKeys();
        foreach ($sessKeys as $sessKey) {
            unset(Yii::app()->request->cookies[$sessKey]);
        }
    }
}