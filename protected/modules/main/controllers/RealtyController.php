<?php

class RealtyController extends Frontend
{
    public $apiClass;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'single', 'add', 'favorite', 'preview', 'previewAd', 'sale', 'reset', 'print', 'type', 'listType', 'bid', 'hot','offer', 'priceByOffer'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    protected function beforeAction($action)
    {
        $this->apiClass = Yii::createComponent('offer.models.ApiOffer');
        return parent::beforeAction($action);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($param = null)
    {
        $selected = array();
        $this->apiClass = Yii::createComponent('offer.models.CbApiOffer');
        /*$dataProvider = new CActiveDataProvider('RealtyOffer', array(
            'pagination'=>array(
                  'pageSize'=>9,
              ),
        ));*/

        $this->footer_filter = true;
        $this->footer_favorite = true;
        if (!Yii::app()->request->isAjaxRequest) {
            
            //$_POST['realtyOffer'][] = RealtyOffer::RENT;
            //$_POST['realtyType'][] = Realty::LAND_POT;

            if (in_array($param, array(RealtyOffer::SALE, RealtyOffer::RENT))) {
                $_POST['realtyOffer'][] = $param;
            }
        }

        //При смене языка восстанавливать поиск и пагинацию
        $language_is_changed = false;
        if (Yii::app()->session['language_is_changed']) {
            $language_is_changed = true;
            unset(Yii::app()->session['language_is_changed']);
        }

        //При пагинации сохранять позицию, только при поиске
        if (isset($_GET['RealtyOffer_page'])) {
            $getData = $_GET['RealtyOffer_page'];

            $cookie = new CHttpCookie('RealtyOffer_page', $getData);
            $cookie->expire = time()+60*60*3;//на 3 часа запомнить
            Yii::app()->request->cookies['RealtyOffer_page'] = $cookie;

        } elseif (isset($_GET['ajax']) && Yii::app()->request->cookies['RealtyOffer_page']) {
            if ($_GET['ajax'] == 'realty-list') {
                $getData = 1;

                $cookie = new CHttpCookie('RealtyOffer_page', $getData);
                $cookie->expire = time()+60*60*3;//на 3 часа запомнить
                Yii::app()->request->cookies['RealtyOffer_page'] = $cookie;

                //восстановим данные для поиска при пагинации
                if (isset(Yii::app()->request->cookies['list-filter-form'])){
                    $_POST = CJSON::decode(Yii::app()->request->cookies['list-filter-form']->value);
                }
            } else {
                $_GET['RealtyOffer_page'] = Yii::app()->request->cookies['RealtyOffer_page']->value;
            }
        } elseif ((Yii::app()->request->cookies['RealtyOffer_page'] && isset($_POST['extendFilters']))
            || $language_is_changed) {
            $_GET['RealtyOffer_page'] = Yii::app()->request->cookies['RealtyOffer_page']->value;
        }

        if (isset($_GET['RealtyOffer_page']) || $language_is_changed) {
            //восстановим данные для поиска при пагинации
            if (isset(Yii::app()->request->cookies['list-filter-form']) && !Yii::app()->request->isPostRequest) {
                $_POST = CJSON::decode(Yii::app()->request->cookies['list-filter-form']->value);
            }
        }

        if(Yii::app()->request->isPostRequest){

            $postData = $_POST;

            if (isset($postData['moneyFilter'])){
                $temp = $this->parseMoneyFilter($postData['moneyFilter']);
                $postData['moneyMinFilter'] = $temp['moneyMinFilter'];
                $postData['moneyMaxFilter'] = $temp['moneyMaxFilter'];
            }

            //сохраним данные для поиска при пагинации
            $cookie = new CHttpCookie('list-filter-form', CJSON::encode($postData));
            $cookie->expire = time()+60*60*3;//на 3 часа запомнить
            Yii::app()->request->cookies['list-filter-form'] = $cookie;

            foreach ($postData as $key=>$item) {
                if($item || is_numeric($item)){
                    Yii::app()->session[$key] = $item;
                    $cookie = new CHttpCookie($key, $item);
                    $cookie->expire = time()+60*60*3;//на 3 часа запомнить
                    Yii::app()->request->cookies[$key] = $cookie;
                }
            }
        }

//        $sessKeys = Yii::app()->session->getKeys();
//        foreach ($sessKeys as $sessKey) {
//                //$selected[$sessKey] = isset(Yii::app()->session[$sessKey])?Yii::app()->session[$sessKey]:null;
//            $selected[$sessKey] =  Yii::app()->request->cookies[$sessKey]?Yii::app()->request->cookies[$sessKey]->value:null;
//        }

        $selected = $this->apiClass->getCookiesFilterValues();
        if (isset($_POST['extendFilters']) || isset($_POST['extendFiltersMain'])){
            $dataProvider = $this->apiClass->getExtendOffers();
        }else{
            //Очистка выбранных фильтров, пагинации и поиска
            $this->apiClass->clearCookiesFilterValues();
            unset(Yii::app()->request->cookies['RealtyOffer_page']);
            unset(Yii::app()->request->cookies['list-filter-form']);
            $selected = [];
            $dataProvider = $this->apiClass->getOffers();
        }
        $this->render('index', array(
            'dataProvider'=>$dataProvider,
            'selected'=>$selected,
//            'type'=>isset($_POST['realtyType'])?$_POST['realtyType']:null,
            'type'=> $selected['realtyType'] ? $selected['realtyType']:null,
        ));
    }

    public function parseMoneyFilter($postData)
    {
        switch ($postData) {
            case '<150':
                $res['moneyMinFilter'] = 0;
                $res['moneyMaxFilter'] = 150;
                break;
            case '150-250':
                $res['moneyMinFilter'] = 150;
                $res['moneyMaxFilter'] = 250;
                break;
            case '250-500':
                $res['moneyMinFilter'] = 250;
                $res['moneyMaxFilter'] = 500;
                break;
            case '500-1000':
                $res['moneyMinFilter'] = 500;
                $res['moneyMaxFilter'] = 1000;
                break;
            case '>1000':
                $res['moneyMinFilter'] = 1000;
                $res['moneyMaxFilter'] = 0;
                break;
            case '<15000':
                $res['moneyMinFilter'] = 0;
                $res['moneyMaxFilter'] = 15000;
                break;
            case '15000-25000':
                $res['moneyMinFilter'] = 15000;
                $res['moneyMaxFilter'] = 25000;
                break;
            case '25000-50000':
                $res['moneyMinFilter'] = 25000;
                $res['moneyMaxFilter'] = 50000;
                break;
            case '50000-100000':
                $res['moneyMinFilter'] = 50000;
                $res['moneyMaxFilter'] = 100000;
                break;
            case '>100000':
                $res['moneyMinFilter'] = 100000;
                $res['moneyMaxFilter'] = 0;
                break;
        }
        return $res;
    }

public function actionHot($param = null)
    {
        $selected = array();
        $this->apiClass = Yii::createComponent('offer.models.CbApiOffer');

        $this->footer_filter = true;
        $this->footer_favorite = true;
        if (!Yii::app()->request->isAjaxRequest) {
            if (in_array($param, array(RealtyOffer::SALE, RealtyOffer::RENT))) {
                $_POST['realtyOffer'][] = $param;
            }
        }

        $postData = $_POST;

        foreach ($postData as $key=>$item) {
            if($item){
                Yii::app()->session[$key] = $item;
            }
        }

        if(Yii::app()->request->isPostRequest){
            //echo CVarDumper::dump($_POST,10,true);exit;

            $sessKeys = Yii::app()->session->getKeys();
            foreach ($sessKeys as $sessKey) {
                if(isset($_POST[$sessKey])){
                    $selected[$sessKey] = Yii::app()->session[$sessKey];
                }else{
                    $selected[$sessKey] = null;
                }
            }
        }

        if(isset($_POST['extendFilters'])){
            $dataProvider = $this->apiClass->getExtendOffersHot();
        }else{
            $dataProvider = $this->apiClass->getOffersHot();
        }



        $this->render('index', array(
            'dataProvider'=>$dataProvider,
            'selected'=>$selected,
            'type'=>isset($_POST['realtyType'])?$_POST['realtyType']:null,
        ));
    }

    /**
     * Contact page
     */
    public function actionSingle($id)
    {
        $this->footer_phone = true;
        $realtyOffer = $this->apiClass->getOffer($id);

        if (!$realtyOffer) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        if(isset($_POST['ajax']) && ($_POST['ajax']==='request-visit-form'
                || $_POST['ajax']==='request-visit-form-sm' || $_POST['ajax']==='request-visit-form-lg'))
        {
            $visit = new RequestVisit();
            echo CActiveForm::validate($visit);
            Yii::app()->end();
        }

        if(Yii::app()->request->isPostRequest){
            $visit = new RequestVisit();
            $visit->setScenario('create');
            $visit->attributes = $_POST['RequestVisit'];
            if($visit->save()){
                Yii::app()->user->setFlash('success', Yii::t('MainModule.main', 'Спасибо за Вашу заявку! В ближайшее время мы свяжемся с вами.'));
                $this->redirect(Yii::app()->request->urlReferrer);
            }else{
                Yii::app()->user->setFlash('error', Yii::t('MainModule.main', CHtml::errorSummary($visit)));
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

        /**
         * Запомнить просмотренное объявление
         */
        Yii::app()->recently->setProperty($realtyOffer->id);

        $recently = $realtyOffer->getSingleRecently(3);

        $realty = $realtyOffer->realty;
        $realtyAddress = $realtyOffer->realty->addressTable;
        $realtyDetailed = $realtyOffer->realty->realtyDetailed;

        switch ($realty->type) {
            case Realty::APARTMENTS:
                $sql = "SELECT * FROM `realty_offer` 
                        JOIN realty ON realty_offer.realty_id=realty.id 
                        JOIN realty_address ON realty_address.realty_id=realty.id 
                        JOIN realty_detailed_description ON realty_detailed_description.realty_id=realty.id 
                        WHERE realty_offer.type='{$realtyOffer->type}' 
                        AND realty_address.city_district='{$realtyAddress->city_district}' 
                        AND realty_detailed_description.rooms='{$realtyDetailed->rooms}' 
                        AND realty_detailed_description.newly_built='{$realtyDetailed->newly_built}' 
                        AND realty_offer.id!='{$realtyOffer->id}' limit 3;";
                break;
            case Realty::COMMERTIAL:
                $sql = "SELECT * FROM `realty_offer` 
                        JOIN realty ON realty_offer.realty_id=realty.id 
                        JOIN realty_address ON realty_address.realty_id=realty.id 
                        WHERE realty_offer.type='{$realtyOffer->type}' 
                        AND realty_address.city_district='{$realtyAddress->city_district}'
                        AND realty.type='{$realty->type}' limit 3;";
                break;
            case Realty::LAND_POT:
                $sql = "SELECT * FROM `realty_offer` 
                        JOIN realty ON realty_offer.realty_id=realty.id 
                        JOIN realty_address ON realty_address.realty_id=realty.id 
                        WHERE realty_offer.type='{$realtyOffer->type}' 
                        AND realty_address.city_district='{$realtyAddress->city_district}'
                        AND ABS(realty.space_sq_meters - '{$realty->space_sq_meters}') < 500 limit 3;";
                break;
            case Realty::ESTATE:
                $sql = "SELECT * FROM `realty_offer` 
                        JOIN realty ON realty_offer.realty_id=realty.id 
                        JOIN realty_address ON realty_address.realty_id=realty.id 
                        WHERE realty_offer.type='{$realtyOffer->type}' 
                        AND realty_address.city_district='{$realtyAddress->city_district}'
                        AND ABS(realty_offer.ammount - '{$realtyOffer->ammount}') < 30000 limit 3;";
                break;
            default:
                $sql = "SELECT * FROM `realty_offer` 
                        JOIN realty ON realty_offer.realty_id=realty.id 
                        WHERE realty_offer.type='{$realtyOffer->type}' 
                        AND realty.type='{$realty->type}' limit 3;";
                break;
        }

        $related = RealtyOffer::model()->findAllBySql($sql);
        //id другие, поэтому по результатам снова выбираем нормальными методами по realty_id
        $temp =[];
        foreach ($related as $temp_item){
            $temp[]=RealtyOffer::model()->findByAttributes(array('realty_id' => $temp_item->realty_id));
        }
        $related=$temp;
        $this->render('single', array(
            'realtyOffer' => $realtyOffer,
            'recently'=>$recently,
            'related'=>$related
        ));
    }

    public function actionPrint($id)
    {
        $this->layout = Yii::app()->getModule('main')->getLayoutAlias('print');

        $realtyOffer = $this->apiClass->getOffer($id);

        if (!$realtyOffer) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        $tempDir = ['tempDir' => __DIR__ . '/../../../runtime/tmp'];

        require_once __DIR__ . '/../../../vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf($tempDir);

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.cybtronix.assets.css') . '/bootstrap.min.css');
        $mpdf->WriteHTML($stylesheet, 1);

        $stylesheet1 = file_get_contents(Yii::getPathOfAlias('webroot.themes.cybtronix.assets.css') . '/print.css');
        $mpdf->WriteHTML($stylesheet1, 1);

        /*echo $this->render('print', array(
            'realtyOffer' => $realtyOffer,
        ), true);*/

        $mpdf->WriteHTML(
            $this->render('print', array(
                'realtyOffer' => $realtyOffer,
            ), true)
        );

        $mpdf->Output();
    }

    public function actionFavorite()
    {
        $this->footer_phone = true;
        $realtyOffers = $this->apiClass->getFavorite();
        $this->render('favorite', array('dataProvider' => $realtyOffers));
    }

    public function actionBid()
    {
        $auction_id = intval($_POST['auction']);
        $offer_id = intval($_POST['offer']);
        $name = CHtml::encode($_POST['name']);
        $phone = CHtml::encode($_POST['phone']);
        $bid = CHtml::encode($_POST['bid']);

        $model = new Bids();
        $model->setScenario('create');
        $model->attributes = $_POST['Bids'];
        $model->auction_id = $auction_id;
        $model->name = $name;
        $model->phone = $phone;
        $model->bid = $bid;
        $model->created_at = date('Y-m-d H:i:s');

        if($model->save()){
            echo json_encode(array(
                'result'=>'success',
                'message'=>Yii::t('MainModule.main', 'Оферта принята')
            ));
        }else{
            echo json_encode(array(
                'result'=>'error',
                'message'=>Yii::t('MainModule.main', 'Произошла ошибка! Оферта не принята. Свяжитесть с администрацией сервиса.'.CHtml::errorSummary($model))
            ));
        }
    }

    public function actionPreview()
    {
        $post = Yii::app()->session['post'];

        if (!$post) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        $this->render('preview', array('post' => $post));
    }

    public function actionPreviewAd()
    {
        $post = Yii::app()->session['post'];

        if (!$post) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        //echo CVarDumper::dump($post, 10, true);exit;
        $this->render('preview_without_realty', array('post' => $post));
    }

    public function actionType()
    {
        $apiOffer = Yii::createComponent('offer.models.CbApiOffer');

        $selected = $apiOffer->getCookiesFilterValues();

        $result = array();
        if(isset($_GET['type'])){
            switch ($_GET['type']){
                case Realty::APARTMENTS:
                    $housingStock = $apiOffer->getHousingStock();
                    array_unshift($housingStock, Yii::t("MainModule.main", 'Жилой фонд'));

                    $roomsFilter = $apiOffer->getRoomsFilter();
                    array_unshift($roomsFilter, Yii::t("MainModule.main", 'Количество комнат'));

                    $housing = $this->renderPartial('_housing_stock', array('housingStock'=>$housingStock, 'selected'=>$selected), true);
                    $rooms = $this->renderPartial('_room_filter', array('roomsFilter'=>$roomsFilter, 'selected'=>$selected), true);
                    $result['type'] = Realty::APARTMENTS;
                    $result['housing'] = $housing;
                    $result['rooms'] = $rooms;
                    break;
                case Realty::LAND_POT:
                    $purposeLand = RealtyDetailedDescription::model()->getLandTypes();
                    array_unshift($purposeLand, Yii::t("MainModule.main", 'Назначение участка'));

                    $areaFilter = $apiOffer->getAreaFilter();
                    array_unshift($areaFilter, Yii::t("MainModule.main", 'Площадь участка'));

                    $purpose = $this->renderPartial('_land_pot_purpose_filter', array('data'=>$purposeLand, 'selected'=>$selected), true);
                    $area = $this->renderPartial('_land_pot_area_filter', array('areaFilter'=>$areaFilter, 'selected'=>$selected), true);
                    $result['type'] = Realty::LAND_POT;
                    $result['purpose'] = $purpose;
                    $result['area'] = $area;
                    break;
                case Realty::ESTATE:
                    $roomsFilter = $apiOffer->getRoomsFilter();
                    array_unshift($roomsFilter, Yii::t("MainModule.main", 'Количество комнат'));

                    $areaFilter = $apiOffer->getAreaFilter();
                    array_unshift($areaFilter, Yii::t("MainModule.main", 'Площадь участка'));

                    $rooms = $this->renderPartial('_room_filter', array('roomsFilter'=>$roomsFilter, 'selected'=>$selected), true);
                    $area = $this->renderPartial('_land_pot_area_filter', array('areaFilter'=>$areaFilter, 'selected'=>$selected), true);
                    $result['type'] = Realty::ESTATE;
                    $result['rooms'] = $rooms;
                    $result['area'] = $area;
                    break;
                case Realty::COMMERTIAL:
                    $squareFilter = $apiOffer->getSquareFilter();
                    array_unshift($squareFilter, Yii::t("MainModule.main", 'Метраж'));

                    $conditionFilter = RealtyDetailedDescription::model()->getSpaseConditions();
                    array_unshift($conditionFilter, Yii::t("MainModule.main", 'Состояние помещений'));

                    $square = $this->renderPartial('_square_filter', array('squareFilter'=>$squareFilter, 'selected'=>$selected), true);
                    $condition = $this->renderPartial('_condition_filter', array('conditionFilter'=>$conditionFilter, 'selected'=>$selected), true);
                    $result['type'] = Realty::COMMERTIAL;
                    $result['square'] = $square;
                    $result['condition'] = $condition;
                    break;
                case Realty::BUSINESS:
                    $squareFilter = $apiOffer->getSquareFilter();
                    array_unshift($squareFilter, Yii::t("MainModule.main", 'Метраж'));

                    $businessType = RealtyDetailedDescription::model()->getSubtypes();
                    array_unshift($businessType, Yii::t("MainModule.main", 'Все'));

                    $businessType = $this->renderPartial('_business_type_filter', array('businessType'=>$businessType, 'selected'=>$selected), true);
                    $square = $this->renderPartial('_square_filter', array('squareFilter'=>$squareFilter, 'selected'=>$selected), true);
                    $result['type'] = Realty::BUSINESS;
                    $result['businessType'] = $businessType;
                    $result['square'] = $square;
                    break;
                default:
                    //'apartments';
            }

            echo json_encode($result);
        }
        Yii::app()->end();
    }

    public function actionListType()
    {
        $apiOffer = Yii::createComponent('offer.models.CbApiOffer');
        $city_id = 618426;

        $selected = $apiOffer->getCookiesFilterValues();

        //Установим для фильтра цены в пост выбранный тип предложения
        if (isset($selected['realtyOffer'])) {
        $_POST['realtyOffer'] = $selected['realtyOffer'];
        }

        $result = array();
        if(isset($_GET['type'])){

            $type = CHtml::encode($_GET['type']);

            switch ($type){
                case Realty::APARTMENTS:
                    $form = $this->renderPartial('filters/_form_apartments', array(
                        'filters'=>$apiOffer->getExtendsFilters($city_id),
                        'selected'=>$selected,
                        'type'=>$type
                    ), true);
                    $result['type'] = Realty::APARTMENTS;
                    $result['form'] = $form;
                    break;
                case Realty::LAND_POT:
                    $form = $this->renderPartial('filters/_form_land', array(
                        'filters'=>$apiOffer->getExtendsFilters($city_id),
                        'selected'=>$selected,
                        'type'=>$type
                    ), true);
                    $result['type'] = Realty::LAND_POT;
                    $result['form'] = $form;
                    break;
                case Realty::ESTATE:
                    $form = $this->renderPartial('filters/_form_estate', array(
                        'filters'=>$apiOffer->getExtendsFilters($city_id),
                        'selected'=>$selected,
                        'type'=>$type
                    ), true);
                    $result['type'] = Realty::ESTATE;
                    $result['form'] = $form;
                    break;
                case Realty::COMMERTIAL:
                    $form = $this->renderPartial('filters/_form_commercial', array(
                        'filters'=>$apiOffer->getExtendsFilters($city_id),
                        'selected'=>$selected,
                        'type'=>$type
                    ), true);
                    $result['type'] = Realty::COMMERTIAL;
                    $result['form'] = $form;
                    break;
                case Realty::BUSINESS:
                    $form = $this->renderPartial('filters/_form_business', array(
                        'filters'=>$apiOffer->getExtendsFilters($city_id),
                        'selected'=>$selected,
                        'type'=>$type
                    ), true);
                    $result['type'] = Realty::BUSINESS;
                    $result['form'] = $form;
                    break;
                default:
                    $form = $this->renderPartial('filters/_default', array(
                        'filters'=>$apiOffer->getExtendsFilters($city_id),
                        'selected'=>$selected,
                        'type'=>$type
                    ), true);
                    $result['type'] = $type;
                    $result['form'] = $form;
            }

            echo json_encode($result);
        }

        Yii::app()->end();
    }

    public function actionOffer()
    {
        $apiOffer = Yii::createComponent('offer.models.CbApiOffer');

        $result = array();
        if (isset($_GET['offer'])) {
            $selected = $apiOffer->getCookiesFilterValues();

            $moneyFilter = $apiOffer->getMoneyFilterForOfferChange($_GET['offer']);
            array_unshift($moneyFilter, Yii::t("MainModule.main", 'Цена'));

            $result['moneyFilter'] = $this->renderPartial('_realty_offer_filter', array('moneyFilter' => $moneyFilter,'selected'=>$selected), true);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionPriceByOffer()
    {
        $apiOffer = Yii::createComponent('offer.models.CbApiOffer');

        $result = array();

        if (isset($_GET['offer'])) {
            //Запишем установленное значение для выбора типа недвижимости
            $item = $_GET['offer'];
            $key = 'realtyOffer';
            if ($item) {
                Yii::app()->session[$key] = $item;
                $cookie = new CHttpCookie($key, $item);
                $cookie->expire = time()+60*60*3;//на 3 часа запомнить
                Yii::app()->request->cookies[$key] = $cookie;
            }

            $selected = $apiOffer->getCookiesFilterValues();

            $moneyFilter = $apiOffer->getMoneyFilterForOfferChange($_GET['offer']);
            array_unshift($moneyFilter, Yii::t("MainModule.main", 'Цена'));


            $result['moneyMinFilter'] = $this->renderPartial('filters/_realty_money_min_filter', array('moneyFilter' => $apiOffer->getMinMaxMoneyFilterForOfferChange($_GET['offer']),'selected'=>$selected), true);
            $result['moneyMaxFilter'] = $this->renderPartial('filters/_realty_money_max_filter', array('moneyFilter' => $apiOffer->getMinMaxMoneyFilterForOfferChange($_GET['offer']),'selected'=>$selected), true);
            $result['moneyFilter'] = $this->renderPartial('filters/_realty_money_filter', array('moneyFilter' => $moneyFilter,'selected'=>$selected), true);

        }

        echo json_encode($result);
        Yii::app()->end();
    }

}
