<?php
Yii::import('main.widgets.YSort');
Yii::import('offer.OfferModule');

/**
 * This is the model class for table "realty_offer".
 *
 * The followings are the available columns in table 'realty_offer':
 * @property integer $id
 * @property integer $realty_id
 * @property string $type
 * @property string $bid_type
 * @property double $ammount
 * @property string $currency
 * @property string $title_ru
 * @property string $title_ro
 * @property string $title_en
 * @property string $street_ru
 * @property string $street_ro
 * @property string $street_en
 * @property string $description_ru
 * @property string $description_ro
 * @property string $description_en
 * @property integer $main_page
 * @property integer $is_active
 * @property integer $views_ru
 * @property integer $views_ro
 * @property integer $views_en
 * @property integer $add_favorite_ru
 * @property integer $add_favorite_ro
 * @property integer $add_favorite_en
 * @property integer $remove_favorite
 *
 * The followings are the available model relations:
 * @property Auction $auction
 * @property Realty $realty
 * @property RealtyOfferVideo[] $realtyOfferVideos
 */
class RealtyOffer extends ActiveRecord
{
    const RENT = 'rent';
    const SALE = 'sale';

    const INSTANT = 'instant';
    const PERMONTH = 'per month';

    const MDL = 'mdl';
    const EURO = 'euro';
    const USD = 'usd';

    public $temp_id;

    /**
     * @var string язык заголовка и описания
     */
    public $lng;

    private $_rooms = false;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'realty_offer';
	}

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => null,
            )
        );
    }

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules =  array(
            array('realty_id, temp_id', 'required', 'on' => 'step0, insert, update'),
            array('title_ru, title_ro, title_en, street_ru, street_ro, street_en, 
            description_ru, description_ro, description_en', 'required', 'on' => 'step1, insert, update'),
            //for create ad without realty
            array('lng', 'required', 'on' => 'ad_step0, insert, update'),
            //for create ad without realty
            array('title_ru', 'requiredTitleRu'),
            array('title_ro', 'requiredTitleRo'),
            array('title_en', 'requiredTitleEn'),
            array('street_ru', 'requiredStreetRu'),
            array('street_ro', 'requiredStreetRo'),
            array('street_en', 'requiredStreetEn'),
            array('description_ru', 'requiredDescriptionRu'),
            array('description_ro', 'requiredDescriptionRo'),
            array('description_en', 'requiredDescriptionEn'),
            //array('lng', 'safe'),
            //for create ad without realty
            array('type, ammount, currency', 'required', 'on' => 'ad_step1, insert, update'),
            array('type, ammount, currency', 'required', 'on' => 'step3, insert, update'),
			array('realty_id, ammount', 'numerical', 'integerOnly'=>true),
            array('temp_id, description_ru, description_ro, description_en, main_page, lng, is_new, created_at', 'safe'),
			array('type, currency', 'length', 'max'=>4),
			array('bid_type', 'length', 'max'=>9),
			array('title_ru, title_ro, title_en', 'length', 'max'=>255),
            array('street_ru, street_ro, street_en', 'length', 'max'=>100),
			array('street_ru, street_ro, street_en', 'default', 'value'=>''),
			array('is_active', 'default', 'value'=>1),
            array('views_ru, views_ro, views_en', 'default', 'value'=>0),
            array('add_favorite_ru, add_favorite_ro, add_favorite_en, remove_favorite', 'default', 'value'=>0),
			array('id, realty_id, type, bid_type, ammount, currency,
			title_ru, title_ro, title_en, description_ru, description_ro, description_en', 'safe', 'on'=>'search'),
		);

		return $rules;
	}

    public function requiredTitleRu($attribute, $params)
    {
        if($this->lng == 'ru' && $this->scenario == 'ad_step0'){
            if(empty($this->title_ru)){
                $this->addError('title_ru','Заполните поле "Заголовок на русском"');
            }
        }
    }

    public function requiredTitleRo($attribute, $params)
    {
        if($this->lng == 'ro' && $this->scenario == 'ad_step0'){
            if(empty($this->title_ro)){
                $this->addError('title_ro','Заполните поле "Заголовок на молдавском"');
            }
        }
    }

    public function requiredTitleEn($attribute, $params)
    {
        if($this->lng == 'en' && $this->scenario == 'ad_step0'){
            if(empty($this->title_en)){
                $this->addError('title_en','Заполните поле "Заголовок на английском"');
            }
        }
    }

    public function requiredStreetRu($attribute, $params)
    {
        if($this->lng == 'ru' && $this->scenario == 'ad_step0'){
            if(empty($this->street_ru)){
                $this->addError('street_ru','Заполните поле "Название улицы на русском"');
            }
        }
    }

    public function requiredStreetRo($attribute, $params)
    {
        if($this->lng == 'ro' && $this->scenario == 'ad_step0'){
            if(empty($this->street_ro)){
                $this->addError('street_ro','Заполните поле "Название улицы на молдавском"');
            }
        }
    }

    public function requiredStreetEn($attribute, $params)
    {
        if($this->lng == 'en' && $this->scenario == 'ad_step0'){
            if(empty($this->street_en)){
                $this->addError('street_en','Заполните поле "Название улицы на английском"');
            }
        }
    }

    public function requiredDescriptionRu($attribute, $params)
    {
        if($this->lng == 'ru' && $this->scenario == 'ad_step0'){
            if(empty($this->description_ru)){
                $this->addError('description_ru','Заполните поле "Описание на русском"');
            }
        }
    }

    public function requiredDescriptionRo($attribute, $params)
    {
        if($this->lng == 'ro' && $this->scenario == 'ad_step0'){
            if(empty($this->description_ro)){
                $this->addError('description_ro','Заполните поле "Описание на молдавском"');
            }
        }
    }

    public function requiredDescriptionEn($attribute, $params)
    {
        if($this->lng == 'en' && $this->scenario == 'ad_step0'){
            if(empty($this->description_en)){
                $this->addError('description_en','Заполните поле "Описание на английском"');
            }
        }
    }

//    public function afterFind()
//    {
//        $this->saveCounters(array('views_' . Yii::app()->language => 1));
//    }

    public function countViews()
    {
        //Если нет с таким пользователем для предложения и для текущего языка, то ищем нет ли
        //с таким пользователем для предложения и устанавливаем 1 в соответств язык
        $RealtyOfferIsViewedByUserCurrLang = RealtyOfferUserView::model()->findByAttributes(['user_id' => Yii::app()->user->id, 'realty_offer_id' => $this->id, 'viewed_'.Yii::app()->language => 1]);
        if (!$RealtyOfferIsViewedByUserCurrLang) {
            $this->saveCounters(array('views_'.Yii::app()->language => 1));
            $RealtyOfferIsViewedByUser = RealtyOfferUserView::model()->findByAttributes(['user_id' => Yii::app()->user->id, 'realty_offer_id' => $this->id]);
            if ($RealtyOfferIsViewedByUser) {
                $RealtyOfferIsViewedByUser->saveAttributes(['viewed_'.Yii::app()->language => 1]);
            } else {
                $new = new RealtyOfferUserView();
                $new->user_id = Yii::app()->user->id;
                $new->realty_offer_id = $this->id;
                switch (Yii::app()->language){
                    case 'ru':
                        $new->viewed_ru = 1;
                        break;
                    case 'ro':
                        $new->viewed_ro = 1;
                        break;
                    case 'en':
                        $new->viewed_en = 1;
                        break;
                }
                $new->save();
            }
        }
    }

    public function afterSave()
    {
        /**
         * После сохранения объявения, зачем то пишем в item_id хэш из temp_id
         * Это при сохранении без объекта
         * @todo нужно проверить почему
         */
        if(Yii::app()->settings->get(Settings::GENERAL, 'ad_creation')){
            MultipleImages::model()->updateAll(array('item_id' => $this->temp_id),'item_id = :item_id AND content_type="realtyoffer"', array(':item_id' => $this->temp_id));
        }else{
            MultipleImages::model()->updateAll(array('item_id' => $this->id),'item_id = :item_id AND content_type="realtyoffer"', array(':item_id' => $this->temp_id));
        }

        if (isset($_POST['OfferParameter'])) {
            OfferParameter::model()->deleteAll('realty_offer_id = :realty_offer_id',
                array(':realty_offer_id' => $this->id));

            foreach ($_POST['OfferParameter'] as $value) {
                $modelParam = new OfferParameter();
                $modelParam->realty_offer_id = $this->id;
                $modelParam->parameter = $value['parameter'];
                if(!$modelParam->save()) {
                    Yii::log(CHtml::errorSummary($modelParam), "error");
                }
            }
        }

        if (isset($_POST['RealtyOfferVideo']['url'])) {
            /*foreach ($_POST['RealtyOfferVideo']['url'] as $item) {
                $offerVideo = new RealtyOfferVideo();
                $offerVideo->offer_id = $this->id;
                $offerVideo->url = YoutubeCode::getCode($item);
                $offerVideo->save();
            }*/

            $offerVideo = new RealtyOfferVideo();
            $offerVideo->offer_id = $this->id;
            $offerVideo->url = YoutubeCode::getCode($_POST['RealtyOfferVideo']['url']);
            if($offerVideo->url){
                $offerVideo->save();
            }

        }
    }

    public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=> $this->getTableAlias(false, false).'.is_active = 1',
            ),
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'auction' => array(self::HAS_ONE, 'Auction', 'offer_id', 'condition' => 'status = 1'),
			'realty' => array(self::BELONGS_TO, 'Realty', 'realty_id'),
            'favorite' => array(self::HAS_MANY, 'Favorite', 'offer_id'),
            'contypeImagesList' => array(self::HAS_MANY, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type', 'order' => 'priority ASC', 'params' => array(':type' => $this->getClass())),
            'contypeMainImage' => array(self::HAS_ONE, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type AND is_main = 1', 'params' => array(':type' => $this->getClass())),
            'contypeNotMainImages' => array(self::HAS_MANY, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type AND is_main IS NULL', 'order' => 'priority ASC', 'params' => array(':type' => $this->getClass())),
            'realtyOfferVideos' => array(self::HAS_MANY, 'RealtyOfferVideo', 'offer_id'),
		);
	}

    public static function clearImagesNonExistRealtyOffer()
    {
        MultipleImages::model()->deleteAll('item_id NOT IN (SELECT id FROM realty_offer) AND content_type="realtyoffer"');
    }

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'realty_id' => 'Realty',
			'type' => Yii::t("OfferModule.offer", 'Тип предложения'),
			'bid_type' => Yii::t("OfferModule.offer", 'Cпособ оплаты'),
			'ammount' => Yii::t("OfferModule.offer", 'Цена'),
			'currency' => Yii::t("OfferModule.offer", 'Валюта'),
			'title_ru' => Yii::t("OfferModule.offer", 'Заголовок на русском'),
            'title_ro' => Yii::t("OfferModule.offer", 'Заголовок на молдавском'),
            'title_en' => Yii::t("OfferModule.offer", 'Заголовок на английском'),
            'street_ru' => Yii::t("OfferModule.offer", 'Название улицы на русском'),
            'street_ro' => Yii::t("OfferModule.offer", 'Название улицы на молдавском'),
            'street_en' => Yii::t("OfferModule.offer", 'Название улицы на английском'),
            'description_ru' => Yii::t("OfferModule.offer", 'Описание на русском'),
            'description_ro' => Yii::t("OfferModule.offer", 'Описание на молдавском'),
            'description_en' => Yii::t("OfferModule.offer", 'Описание на английском'),
            'views_ru' => Yii::t("OfferModule.offer", 'Количество просмотров (RU)'),
            'views_ro' => Yii::t("OfferModule.offer", 'Количество просмотров (RO)'),
            'views_en' => Yii::t("OfferModule.offer", 'Количество просмотров (EN)'),
            'add_favorite_ru' => Yii::t("OfferModule.offer", 'Добавлено в избранное (RU)'),
            'add_favorite_ro' => Yii::t("OfferModule.offer", 'Добавлено в избранное (RO)'),
            'add_favorite_en' => Yii::t("OfferModule.offer", 'Добавлено в избранное (EN)'),
            'remove_favorite' => Yii::t("OfferModule.offer", 'Удалено из избранного'),
            'lng' => Yii::t("OfferModule.offer", 'Язык объявления'),
            'main_page' => Yii::t("OfferModule.offer", 'Разместить на главной странице'),
		);
	}

	public function search($criteria = null)
	{
	    //echo CVarDumper::dump($_POST,10,true);exit;
	    $with = array('realty');
        $apiClass = Yii::createComponent('offer.models.CbApiOffer');

        if (!$criteria) {
            $criteria=new CDbCriteria;
        } else {
            $with[] = $criteria->with;
        }

		$criteria->compare('id',$this->id);
		$criteria->compare('realty_id',$this->realty_id);
        $criteria->compare('type',$this->type,true);
		$criteria->compare('bid_type',$this->bid_type,true);
		$criteria->compare('ammount',$this->ammount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('street_ru',$this->street_ru,true);
		$criteria->compare('description_ru',$this->description_ru,true);
        $criteria->compare('is_active',$this->is_active,true);
        $criteria->compare('t.is_new',$this->is_new,true);

        /**
         * Район
         */
        if (isset($_POST['districts'])) {
            $in = $this->getPostValues('districts');

            if ($in) {
                $with[] = 'realty.addressTable';
                $criteria->addInCondition('addressTable.city_district', $in);
            }
        }

        /**
         * Тип предложения(аренда/продажа)
         */
        if (isset($_POST['realtyOffer'])) {
            $in = $this->getPostValues('realtyOffer');

            if ($in) {
                $criteria->addInCondition($this->getTableAlias(false, false).'.type', $in);
            }
        }

        /**
         * Тип недвижимости(квартира/земельный участок...)
         */
        if (isset($_POST['realtyType'])) {
            $in = $this->getPostValues('realtyType');

            if ($in) {
                if (in_array('estate', $in) || in_array('apartments', $in)){
                    $this->_rooms = true;
                }

                $criteria->addInCondition('realty.type', $in);
            }
        }

        /**
         * Площадь земли(метры-гектары)
         */
        if (isset($_POST['areaFilter'])) {
            $in = $this->getPostValues('areaFilter');

            if ($in) {
                if ($this->_rooms) {
                    $between = $apiClass->getBetweenRooms($in);
                    $with[] = 'realty.realtyDetailed';

                    if ($between['end'] == 0) {
                        $criteria->addCondition('realtyDetailed.rooms >= :sq_m');
                        $criteria->params[':sq_m'] = $between['start'];
                    } elseif ($between['start'] == 0) {
                        $criteria->addCondition('realtyDetailed.rooms = :sq_m');
                        $criteria->params[':sq_m'] = $between['end'];
                    } else {
                        $criteria->addBetweenCondition(
                            'realtyDetailed.rooms',
                            $between['start'],
                            $between['end']
                        );
                    }
                } else {
                    $between = $apiClass->getBetweenFilter($in);
                    if ($between['end'] == 0) {
                        $criteria->addCondition('realty.space_sq_meters >= :sq_m');
                        $criteria->params[':sq_m'] = $between['start'];
                    } else {
                        $criteria->addBetweenCondition(
                            'realty.space_sq_meters',
                            $between['start'],
                            $between['end']
                        );
                    }
                }
            }
        }

        /**
         * Цена(от-до)
         */
        if (isset($_POST['moneyFilter'])) {
            $in = $this->getPostValues('moneyFilter');

            if ($in) {
                $criteria->addCondition('currency = :euro');
                $criteria->params[':euro'] = RealtyOffer::EURO;

                $between = $apiClass->getBetweenFilter($in);

                if ($between['end'] == 0) {
                    $criteria->addCondition('ammount >= :amm');
                    $criteria->params[':amm'] = $between['start'];
                } else {
                    $criteria->addBetweenCondition(
                        'ammount',
                        $between['start'],
                        $between['end']
                    );
                }
            }
        }

        /**
         * ************************************************
         * Новые фильтры
         * ************************************************
         */

        /**
         * Назначение земли(с/х ...)
         * type
         */
        if(isset($_POST['purposeLand'])){
            $in = $this->getPostValues('purposeLand');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.type', $in);
            }
        }

        /**
         * Количество комнат
         * rooms
         */
        if(isset($_POST['roomsFilter'])){
            $in = $this->getPostValues('roomsFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.rooms', $in);
            }
        }

        /**
         * Этаж
         * floor
         */
        if(isset($_POST['floorFilter'])){
            $in = $this->getPostValues('floorFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.floor', $in);
            }
        }

        /**
         * Количество Этажей
         * number_of_floors
         */
        if(isset($_POST['numFloorFilter'])){
            $in = $this->getPostValues('numFloorFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.number_of_floors', $in);
            }
        }

        /**
         * Жилой фонд(новостройка/вторичка)
         * newly_built
         */
        if(isset($_POST['housingStock'])){
            $in = $this->getPostValues('housingStock');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.newly_built', $in);
            }
        }

        /**
         * Метраж
         */
        if(isset($_POST['squareFilter'])){
            $in = $this->getPostValues('squareFilter');
            if ($in){
                $between = $apiClass->getBetweenFilter($in);
                if ($between['end'] == 0) {
                    $criteria->addCondition('realty.space_sq_meters >= :sq_m');
                    $criteria->params[':sq_m'] = $between['start'];
                } else {
                    $criteria->addBetweenCondition(
                        'realty.space_sq_meters',
                        $between['start'],
                        $between['end']
                    );
                }
            }
        }

        /**
         * Состояние недвижимости
         * space_conditions
         */
        if(isset($_POST['conditionFilter'])){
            $in = $this->getPostValues('conditionFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.space_conditions', $in);
            }
        }

        /**
         * Тип готового бизнеса
         * realtyDetailed.type
         */
        if(isset($_POST['businessType'])){
            $in = $this->getPostValues('businessType');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.type', $in);
            }
        }

        if ($with) {
            $with = array_unique($with);
            $with = array_values($with);
            $criteria->with = $with;
        }

        $sorter = new YSort();
        $sorter->multiSort = true;
        $sorter->attributes = array(
            'ammount' => array(
                'asc'=>'ammount ASC',
                'desc'=>'ammount DESC',
            ),
            'realty.space_sq_meters' => array(
                'asc'=>'realty.space_sq_meters ASC',
                'desc'=>'realty.space_sq_meters DESC',
            ),
            't.id' => array(
                'asc'=>'t.id ASC',
                'desc'=>'t.id DESC',
            ),

        );

        if(Yii::app()->controller->action->id === 'admin'){
            $sorter->defaultOrder = array(
                't.id' => CSort::SORT_ASC,
            );
        }else{
            $sorter->defaultOrder = array(
                't.id' => CSort::SORT_DESC,
                'ammount' => CSort::SORT_ASC,
                'realty.space_sq_meters' => CSort::SORT_DESC,
            );
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('Pagesize' => Yii::app()->params['itemsOffersPerPage']),
            'sort' => $sorter,
		));
	}

    /**
     * Расширенный поиск для страницы списка объявлений
     * @param null $criteria
     * @return CActiveDataProvider
     * @throws CException
     */
    public function extendSearch($criteria = null)
    {
        //echo CVarDumper::dump($_POST,10,true);exit;
        $with = array('realty');
        $apiClass = Yii::createComponent('offer.models.CbApiOffer');

        if (!$criteria) {
            $criteria=new CDbCriteria;
        } else {
            $with[] = $criteria->with;
        }

        $criteria->compare('id',$this->id);
        $criteria->compare('realty_id',$this->realty_id);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('bid_type',$this->bid_type,true);
        $criteria->compare('ammount',$this->ammount);
        $criteria->compare('currency',$this->currency,true);
        $criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('street_ru',$this->street_ru,true);
        $criteria->compare('description_ru',$this->description_ru,true);

        /**
         * Район
         */
        if (isset($_POST['districts'])) {
            $in = $this->getPostValues('districts');

            if (in_array(current($in), [6184260, 6184270])) {
                $string = (string)current($in);
                $cityId = substr($string, 0, -1);
                if ($cityId == 618426) {
                    $districtsCity = CityDistrict::model()->findAll('city_id=:city_id AND suburb=0', [':city_id' => $cityId]);
                    $in = CHtml::listData($districtsCity, 'id', 'id');
                } else {
                    $cityId= 618426;
                    $districtsSuburb = CityDistrict::model()->findAll('city_id=:city_id AND suburb=1', [':city_id' => $cityId]);
                    $in = CHtml::listData($districtsSuburb, 'id', 'id');
                }
            }
            if ($in) {
                $with[] = 'realty.addressTable';
                $criteria->addInCondition('addressTable.city_district', $in);
            }
        }

        /**
         * Тип предложения(аренда/продажа)
         */
        if (isset($_POST['realtyOffer'])) {
            $in = $this->getPostValues('realtyOffer');

            if ($in) {
                $criteria->addInCondition($this->getTableAlias(false, false).'.type', $in);
            }
        }

        /**
         * Тип недвижимости(квартира/земельный участок...)
         */
        if (isset($_POST['realtyType'])) {
            $in = $this->getPostValues('realtyType');

            if ($in) {
                if (in_array('estate', $in) || in_array('apartments', $in)){
                    $this->_rooms = true;
                }

                $criteria->addInCondition('realty.type', $in);
            }
        }

        /**
         * Площадь земли(метры-гектары)
         */
        if (isset($_POST['areaFilter'])) {
            $in = $this->getPostValues('areaFilter');
//            CVarDumper::dump($in,10,1);
//            CVarDumper::dump($this->_rooms,10,1);
//            die();
            if ($in) {
                if ($this->_rooms) {
                    $between = $apiClass->getBetweenRooms($in);
                    $with[] = 'realty.realtyDetailed';

                    if ($between['end'] == 0) {
                        $criteria->addCondition('realtyDetailed.rooms >= :sq_m');
                        $criteria->params[':sq_m'] = $between['start'];
                    } elseif ($between['start'] == 0) {
                        $criteria->addCondition('realtyDetailed.rooms = :sq_m');
                        $criteria->params[':sq_m'] = $between['end'];
                    } else {
                        $criteria->addBetweenCondition(
                            'realtyDetailed.rooms',
                            $between['start'],
                            $between['end']
                        );
                    }
                } else {
                    $between = $apiClass->getBetweenFilter($in);
                    if ($between['end'] == 0) {
                        $criteria->addCondition('realty.space_sq_meters >= :sq_m');
                        $criteria->params[':sq_m'] = $between['start'];
                    } else {
                        $criteria->addBetweenCondition(
                            'realty.space_sq_meters',
                            $between['start'],
                            $between['end']
                        );
                    }
                }
            }
        }

        /**
         * Цена
         */
        if (isset($_POST['moneyFilter'])) {
            $price = $this->getPostValues('moneyFilter');

            if ($price) {
                $between = $apiClass->getBetweenFilter($price);
                if ($between['end'] == 0) {
                    $criteria->addCondition('ammount >= :money');
                    $criteria->params[':money'] = $between['start'];
                } else {
                    $criteria->addBetweenCondition(
                        'ammount',
                        $between['start'],
                        $between['end']
                    );
                }
            }
        }


        /**
         * Мин Цена(от)
         */
        if (isset($_POST['moneyMinFilter'])) {

            $min = intval($_POST['moneyMinFilter']);

            if ($min) {
                $criteria->addCondition('currency = :euro');
                $criteria->params[':euro'] = RealtyOffer::EURO;

                $criteria->addCondition('ammount >= :min');
                $criteria->params[':min'] = $min;
            }
        }

        /**
         * Макс цена до
         */
        if (isset($_POST['moneyMaxFilter'])) {

            $max = intval($_POST['moneyMaxFilter']);
            if ($max) {
                $criteria->addCondition('currency = :euro');
                $criteria->params[':euro'] = RealtyOffer::EURO;

                $criteria->addCondition('ammount <= :max');
                $criteria->params[':max'] = $max;
            }
        }

        /**
         * ************************************************
         * Новые фильтры
         * ************************************************
         */

        /**
         * Назначение земли(с/х ...)
         * type
         */
        if(isset($_POST['purposeLand'])){
            $in = $this->getPostValues('purposeLand');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.type', $in);
            }
        }

        /**
         * Количество комнат
         * rooms
         */
        if(isset($_POST['roomsFilter'])){
            $in = $this->getPostValues('roomsFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.rooms', $in);
            }
        }

        /**
         * Этаж
         * floor
         */
        if(isset($_POST['floorFilter'])){
            $in = $this->getPostValues('floorFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.floor', $in);
            }
        }

        /**
         * Количество Этажей
         * number_of_floors
         */
        if(isset($_POST['numFloorFilter'])){

            $num = current($this->getPostValues('numFloorFilter'));

            if ($num) {
                $with[] = 'realty.realtyDetailed';
//                $criteria->addInCondition('realtyDetailed.number_of_floors', $in);
                $criteria->addCondition('realtyDetailed.number_of_floors <= :numfloors');
                $criteria->params[':numfloors'] = $num;
            }
        }

        /**
         * Спальни
         * floor
         */
        if(isset($_POST['bedroomsFilter'])){
            $in = $this->getPostValues('bedroomsFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.bedrooms', $in);
            }
        }

        /**
         * Жилой фонд(новостройка/вторичка)
         * newly_built
         */
        if(isset($_POST['housingStock'])){
            $in = $this->getPostValues('housingStock');

            if ($in) {
                //0-Первичка и вторичка, 1 - Вторичка, 2 - Первичка. Из-за добавления Первичка и вторичка все увеличилось на 1
                $in = [current($in)-1];
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.newly_built', $in);
            }
        }

        /**
         * Метраж
         */
        if(isset($_POST['squareFilter'])){
            $in = $this->getPostValues('squareFilter');
            if ($in){
                $between = $apiClass->getBetweenFilter($in);
                if ($between['end'] == 0) {
                    $criteria->addCondition('realty.space_sq_meters >= :sq_m');
                    $criteria->params[':sq_m'] = $between['start'];
                } else {
                    $criteria->addBetweenCondition(
                        'realty.space_sq_meters',
                        $between['start'],
                        $between['end']
                    );
                }
            }
        }

        /**
         * Состояние недвижимости
         * space_conditions
         */
        if(isset($_POST['conditionFilter'])){
            $in = $this->getPostValues('conditionFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.space_conditions', $in);
            }
        }

        if(isset($_POST['commercialFilter'])){
            $in = $this->getPostValues('commercialFilter');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.type', $in);
            }
        }

        /**
         * Тип готового бизнеса
         * realtyDetailed.type
         */
        if(isset($_POST['businessType'])){
            $in = $this->getPostValues('businessType');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.type', $in);
            }
        }

        if(isset($_POST['projectType'])){
            $in = $this->getPostValues('projectType');

            if ($in) {
                $with[] = 'realty.realtyDetailed';
                $criteria->addInCondition('realtyDetailed.project_type', $in);
            }
        }

        if ($with) {
            $with = array_unique($with);
            $with = array_values($with);
            $criteria->with = $with;
        }

        $sorter = new YSort();
        $sorter->multiSort = true;
        $sorter->attributes = array(
            'ammount' => array(
                'asc'=>'ammount ASC',
                'desc'=>'ammount DESC',
            ),
            'realty.space_sq_meters' => array(
                'asc'=>'realty.space_sq_meters ASC',
                'desc'=>'realty.space_sq_meters DESC',
            ),
            't.id' => array(
                'asc'=>'t.id ASC',
                'desc'=>'t.id DESC',
            ),

        );

        if(Yii::app()->controller->action->id === 'admin'){
            $sorter->defaultOrder = array(
                't.id' => CSort::SORT_ASC,
            );
        }else{
            $sorter->defaultOrder = array(
                't.id' => CSort::SORT_DESC,
                'ammount' => CSort::SORT_ASC,
                'realty.space_sq_meters' => CSort::SORT_DESC,
            );
        }


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array('Pagesize' => Yii::app()->params['itemsOffersPerPage']),
            'sort' => $sorter,
        ));
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RealtyOffer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTempId() {
        if ($this->id) {
            return $this->id;
        } elseif ($this->temp_id) {
            return $this->temp_id;
        } elseif (empty($this->id) && empty($this->temp_id)) {
            $this->temp_id = YHelper::generateStr(32);
            return $this->temp_id;
        }
    }



    public function getType($value = null)
    {
        $types = array(
            self::RENT => Yii::t("OfferModule.offer", 'Аренда'),
            self::SALE => Yii::t("OfferModule.offer", 'Продажа'),
        );

        if ($value) {
            return isset($types[$value]) ? $types[$value] : Yii::t("OfferModule.offer", 'Все');
        }

        return $types;
    }

    public static function getPreviewType($value = null)
    {
        $types = array(
            self::RENT => Yii::t("OfferModule.offer", 'Аренда'),
            self::SALE => Yii::t("OfferModule.offer", 'Продажа'),
        );

        if ($value) {
            return isset($types[$value]) ? $types[$value] : Yii::t("OfferModule.offer", 'Все');
        }

        return $types;
    }

    public function getBidType($value = null)
    {
        $types = array(
            self::INSTANT => Yii::t("OfferModule.offer", 'Полная стоимость объекта недвижимости'),
            self::PERMONTH => Yii::t("OfferModule.offer", 'Стоимость объекта недвижимости в месяц'),
        );

        if ($value) {
            return isset($types[$value]) ? $types[$value] : Yii::t("OfferModule.offer", 'Все');
        }

        return $types;
    }

    public function getCurrency($value = null)
    {
        $types = array(
            self::MDL => Yii::t("OfferModule.offer", 'MDL'),
//            self::EURO => Yii::t("OfferModule.offer", 'EUR'),
            self::EURO => '€',
            self::USD => Yii::t("OfferModule.offer", 'USD'),
        );

        if ($value) {
            return isset($types[$value]) ? $types[$value] : Yii::t("OfferModule.offer", 'Все');
        }

        return $types;
    }

    public function getFavClass()
    {
        $fav = Favorite::model()->count(
            'user_ip = :user_ip && offer_id = :offer',
            array(
                ':user_ip' => YHelper::get_client_ip(),
                ':offer' => $this->id
            )
        );

        return $fav ? 'button-red' : 'button-grey';
    }

    /**
     * Проверка, находится ли объявление в избранном
     * @return bool
     */
    public function hasFavorite()
    {
        $fav = Favorite::model()->count(
            'user_ip = :user_ip && offer_id = :offer',
            array(
                ':user_ip' => YHelper::get_client_ip(),
                ':offer' => $this->id
            )
        );

        return $fav ? true : false;
    }

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getStreet()
    {
        return $this->{'street_'.Yii::app()->language};
    }

    public function getViews()
    {
        return $this->{'views_'.Yii::app()->language};
    }

    public function getAddFavorite()
    {
        return $this->{'add_favorite_'.Yii::app()->language};
    }

    public function getUnitedImages()
    {
        $tCriteria = new CDbCriteria();
        $tCriteria->condition = 'item_id = :item_realty && content_type = "realty"';
        $tCriteria->addCondition('item_id = :item_offer && content_type = "realtyoffer"', 'OR');
        $tCriteria->order = 'priority ASC';
        $tCriteria->params[':item_realty'] = isset($this->realty) ? $this->realty->id : 0;
        $tCriteria->params[':item_offer'] = $this->id;
        return MultipleImages::model()->findAll($tCriteria);
    }

    public function getUnitedMainImages()
    {
        $tCriteria = new CDbCriteria();
        $tCriteria->condition = 'item_id = :item_offer AND content_type = "realtyoffer"';
        $tCriteria->addCondition('is_main > 0');
        $tCriteria->params[':item_offer'] = $this->id;
        $mainImage = MultipleImages::model()->find($tCriteria);

        if (!$mainImage) {
            $mainImage = $this->realty->contypeMainImage;
        }

        return ($mainImage)?$mainImage->path:null;
    }

    public function getAddress()
    {
        $street = $this->getStreet() ? : $realtyTable->street;
        $realtyTable = $this->realty->addressTable;
        if (!$realtyTable) {
            return $street;
        }
        return $realtyTable->getCountries($realtyTable->country)
            .', '. $realtyTable->getCitiesAndSuburbs($realtyTable->city)
            .', '. $realtyTable->getAllDistrict($realtyTable->city_district)
            .', '. $street;
    }

    public function getShortAddress()
    {
        $street = $this->getStreet() ? : $realtyTable->street;
        $realtyTable = $this->realty->addressTable;
        if (!$realtyTable) {
            return $street;
        }
        return $realtyTable->getAllDistrict($realtyTable->city_district)
            .', '. $street;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        if ($this->type == self::RENT) {
            return number_format($this->ammount, 0, '.', ' ') . ' ' . $this->getCurrency($this->currency) .  '/' . Yii::t("MainModule.main", "месяц");
        } else {
            return number_format($this->ammount, 0, '.', ' ') . ' ' . $this->getCurrency($this->currency);
        }
    }

    public function getLang()
    {
        return array(
            'ru'=>Yii::t('RealtyModule.realty', 'На русском'),
            'ro'=>Yii::t('RealtyModule.realty', 'На молдавском'),
            'en'=>Yii::t('RealtyModule.realty', 'На английском'),
        );
    }
    /**
     * Установка языка при редактировании, при включенной опции "Без создания объекта"
     * @return string
     */
    public function getSelectedLang()
    {
        if($this->street_ru){
            return 'ru';
        }
        if($this->street_ro){
            return 'ro';
        }
        if($this->street_en){
            return 'en';
        }
        return 'ru';
    }

    public function viewBidType()
    {
        if($this->type == self::RENT){
           return '/'.Yii::t("base", "в месяц");
        }else{
            return '';
        }
    }

    public function getMetaTagDiscription()
    {
        $realtyTable = $this->realty->addressTable;
        $street = $this->getStreet() ? : $realtyTable->street;
        $address = '';

        if (!$realtyTable) {
            $address = $street;
        } else {
        $address = $realtyTable->getCitiesAndSuburbs($realtyTable->city)
            .', '. $realtyTable->getCountries($realtyTable->country)
            .', '. $realtyTable->getAllDistrict($realtyTable->city_district)
            .', '. $street;
        }

        $res = Yii::t("MainModule.main", "Квартиры в "). $address;
        $res .= ', ' . $this->getType($this->type) . ' ' . Yii::t("MainModule.main", "квартиры");
        return $res;
    }

    public function getMetaTagKeywords()
    {
        $realty = $this->realty;
        $realtyTable = $realty->addressTable;
        $street = $this->getStreet() ? : $realtyTable->street;
        $address = '';

        if (!$realtyTable) {
            $address = $street;
        } else {
            $address = $realtyTable->getCitiesAndSuburbs($realtyTable->city)
                .', '. $realtyTable->getCountries($realtyTable->country)
                .', '. $realtyTable->getAllDistrict($realtyTable->city_district)
                .', '. $street;
        }

        $realtytype = $realty->getRealtyType($realty->type);

        $res = $this->getType($this->type) . ', ';
        $res .= $address;
        $res .= ', ' . $realtytype;
        $res .= ', ' . $this->getPrice();
        return $res;
    }

    /**
     * Возвращает последние просмотренные объявления
     * @param $limiter
     * @return array|RealtyOffer[]
     */
    public function getSingleRecently($limiter)
    {
        //Ранее просмотренные id
        $recently = Yii::app()->recently->getProperty();
        //Получить объекты по id из кукисов, чтобы узнать существуют ли они
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $recently);
        $criteria->addCondition("id!={$this->id}");
        $criteria->limit = $limiter;
        $properties = RealtyOffer::model()->findAll($criteria);
        $recently = array_keys(CHtml::listData($properties, "id", "id"));

        //Если есть массив ранее просмотренных
        if ($recently) {
            //Если количество просмотренных меньше 3
            if(count($recently) < $limiter){
                $limit = $limiter - count($recently);//1,2
            }else{
                $limit = $limiter;//3
            }
            //Получить объекты по id из кукисов
//            $criteria = new CDbCriteria();
//            $criteria->addInCondition("id", $recently);
//            $criteria->addCondition("id!={$this->id}");
//            $criteria->limit = $limiter;
//            $properties = RealtyOffer::model()->findAll($criteria);

            //Если количество полученных объектов меньше 3, добрать еще
            if (count($properties) < $limiter) {
                $in = $this->randomIn($limit, $recently);
                $criteria2 = new CDbCriteria();
                $criteria2->addInCondition("id", $in);
                $randomProperties = RealtyOffer::model()->findAll($criteria2);
                return array_merge($properties, $randomProperties);
            }

            return $properties;
        } else {
            //Если нет просмотренных, получить три случайных объекта
            $criteria = new CDbCriteria();
            $in = $this->randomIn($limiter);
            $criteria->addInCondition("id", $in);
            $criteria->limit = $limiter;
            $properties = RealtyOffer::model()->findAll($criteria);
            return $properties;
        }
    }

    private function randomIn($limit, $exist = null)
    {
        if($exist){
            $impolode = implode(',', $exist);
            $strIn = " where `id` NOT IN ({$impolode}) AND `id` != {$this->id}";
        }else{
            $strIn = " where `id` != {$this->id}";
        }

        $sql = "select id from realty_offer{$strIn}";
        $result = Yii::app()->db->createCommand($sql)->queryColumn();
        $all = array_flip($result);
        //return array_rand($all, $limit);
        $l = (count($all)>$limit)?$limit:count($all);
        if (empty($l)){$l=1;}
        $return = array_rand($all, $l);

        if(is_array($return)){
            return $return;
        }else{
            return array($return);
        }
    }

    /**
     * Возвращает путь к главному изображению
     * @return string
     */
    public function getPreviewImage()
    {
        $imageObj = $this->contypeMainImage;
        if(!$imageObj){
            $imageObj = $this->realty->contypeMainImage;
        }

        return isset($imageObj->path) ? $imageObj->path : Yii::app()->getModule('main')->themeAssets.'/img/h2.jpg';
    }

    /**
     * Возвращает текст сколько осталось дней
     * @param $daysleft
     * @return string
     */
    public function remainingDays($daysleft)
    {
        if($daysleft){
            return $daysleft .' '. YHelper::plural($daysleft, Yii::t('MainModule.main','день'), Yii::t('MainModule.main','дня'), Yii::t('MainModule.main','дней'));
        }else{
            return Yii::t('MainModule.main','Оферты сделаны');
        }
    }

    public static function getClassName()
    {
        return strtolower(static::class);
    }
}
