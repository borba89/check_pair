<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'realty':
 * @property integer $id
 * @property integer $broker_id
 * @property string $type
 * @property string $address
 * @property string $description
 * @property string $status
 * @property integer $space_sq_meters
 * @property string $created
 *
 * @property RealtyDetailedDescription $realtyDetailed
 * @property RealtyAddress $addressTable
 * @property MultipleImages[] $contypeImagesList
 * @property MultipleImages $contypeMainImage
 * @property MultipleImages[] $contypeNotMainImages
 */
class Realty extends ActiveRecord
{
    /**
     * Земельный участок
     */
    const LAND_POT = 'land_pot';

    /**
     * Дом на земле
     */
    const ESTATE = 'estate';

    /**
     * Квартира
     */
    const APARTMENTS = 'apartments';

    /**
     * Офис
     */
    const OFFICE = 'office';

    /**
     * Производственные площади
     */
    const INDUSTRIAL = 'industrial';

    /**
     * Складские площади
     */
    const WAREHOUSE = 'warehouse';

    /**
     * Коммерческие площади
     */
    const COMMERTIAL = 'commercial';

    /**
     * Готовый бизнес
     */
    const BUSINESS = 'business';

    const OPENED = 'opened';
    const CLOSED = 'closed';

    public $temp_id;
    public $objects;
    public $searchAddress;

    public $addressStreet;
    public $realtyTags;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'realty';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, temp_id', 'required', 'on' => 'step0, insert, update'),
//            array('status', 'in', 'range'=>array('opened', 'closed'), 'allowEmpty'=>false),
            array('temp_id, created', 'safe'),
            array('type', 'in', 'range'=>array(self::LAND_POT, self::ESTATE, self::APARTMENTS,
                self::OFFICE, self::INDUSTRIAL, self::WAREHOUSE, self::COMMERTIAL, self::BUSINESS), 'allowEmpty'=>false),
			array('description', 'safe'),
            array('broker_id', 'safe'),
            array('address', 'default', 'value'=>''),
            array('space_sq_meters', 'default', 'value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, address, description, status, searchAddress', 'safe', 'on'=>'search'),
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
            'broker' => array(self::BELONGS_TO, 'User', 'broker_id'),
            'addressTable' => array(self::HAS_ONE, 'RealtyAddress', 'realty_id'),
            'realtyDetailed' => array(self::HAS_ONE, 'RealtyDetailedDescription', 'realty_id'),
            'offer' => array(self::HAS_ONE, 'RealtyOffer', 'realty_id'),
            'contypeImagesList' => array(self::HAS_MANY, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type', 'order' => 'priority ASC', 'params' => array(':type' => $this->getClass())),
            'contypeMainImage' => array(self::HAS_ONE, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type AND is_main = 1', 'params' => array(':type' => $this->getClass())),
            'contypeNotMainImages' => array(self::HAS_MANY, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type AND is_main IS NULL', 'order' => 'priority ASC', 'params' => array(':type' => $this->getClass())),
            'tagsConnect' => array(self::HAS_MANY, 'RealtyTagsConnection', 'realty_id'),
            'tags' => array(self::MANY_MANY, 'RealtyTags', 'realty_tags_connection(tag_id, realty_id)'),
        );
	}

    public static function clearImagesNonExistRealty()
    {
        MultipleImages::model()->deleteAll('item_id NOT IN (SELECT id FROM realty) AND content_type="realty"');
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'broker_id' => Yii::t("RealtyModule.realty", 'Агент по недвижимости'),
			'type' => Yii::t("RealtyModule.realty", 'Тип недвижимости'),
			'address' => Yii::t("RealtyModule.realty", 'Адрес'),
			'description' => Yii::t("RealtyModule.realty", 'Описание'),
			'status' => Yii::t("RealtyModule.realty", 'Статус'),
            'objects' => Yii::t("RealtyModule.realty", 'Объекты недвижимости'),
            'space_sq_meters' => Yii::t("RealtyModule.realty", 'Площадь'),
            'searchAddress' => Yii::t("RealtyModule.realty", 'Найти по адресу'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        if (!$this->status) {
            $this->status = Realty::OPENED;
        }

        if ($this->searchAddress) {
            $crt = new CDbCriteria;
            $crt->compare('search_string', $this->searchAddress, true);
            $models = RealtyAddress::model()->findAll($crt);
            $in = CHtml::listData($models, 'id', 'realty_id');

            $criteria->addInCondition('id', $in);
        }

		$criteria->compare('type',$this->type,true);
		$criteria->compare('address',$this->address,true);
//		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'attributes' => array(
                    'created' => array(
                        'asc'=>'created ASC',
                        'desc'=>'created DESC',
                        'default'=>'desc',
                    )
                ),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogArticle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @todo выяснить что за url
     * @return mixed
     */
    public function getUrl()
    {
        return Yii::app()->createUrl('/main/realty/single', array('id' => $this->id));
    }

    /**
     * Возвращает масив пользователей для выпадающего списка
     * @return array
     */
    public function getAllUsers()
    {
        $users = User::model()->is_active()->findAll();
        return CHtml::listData($users,'id','fullName');
    }

    /**
     * Возвращает статус сделки
     * Если передано значение $value, возвращается человеко-понятное значение
     * Иначе возвращается массив для выпадающего списка формы
     * @param null $value
     * @return array|mixed|string
     */
    public function getStatus($value = null)
    {
        $types = array(
            self::OPENED => Yii::t("OfferModule.offer", 'Сделка открыта'),
            self::CLOSED => Yii::t("OfferModule.offer", 'Сделка закрыта'),
        );

        if ($value) {
            return isset($types[$value]) ? $types[$value] : Yii::t("OfferModule.offer", 'Все');
        }

        return $types;
    }

    /**
     * Возвращает тип недвижимости
     * Если параметр $value передан, возвращается человеко-понятное значение типа
     * Иначе возвращается массив типов для выпадающего списка
     * @param null $value
     * @return mixed
     */
    public function getRealtyType($value = null)
    {
        $realtyType[self::APARTMENTS] = Yii::t("RealtyModule.realty", 'Квартиры');
        $realtyType[self::ESTATE] = Yii::t("RealtyModule.realty", 'Дома на земле');
        $realtyType[self::LAND_POT] = Yii::t("RealtyModule.realty", 'Земельный участок');
        $realtyType[self::COMMERTIAL] = Yii::t("RealtyModule.realty", 'Коммерческие площади');
        
        //$realtyType[self::OFFICE] = Yii::t("RealtyModule.realty", 'Офис');
        //$realtyType[self::INDUSTRIAL] = Yii::t("RealtyModule.realty", 'Производственные площади');
        //$realtyType[self::WAREHOUSE] = Yii::t("RealtyModule.realty", 'Складские площади');
        //$realtyType[self::BUSINESS] = Yii::t("RealtyModule.realty", 'Готовый бизнес');

        if ($value) {
            return $realtyType[$value];
        }

        return $realtyType;
    }

    /**
     * @throws CDbException
     */
    public function afterSave()
    {
        /**
         * Обновить значения ранее загруженных фотографий
         */
        MultipleImages::model()->updateAll(array('item_id' => $this->id),'item_id = :item_id AND content_type="realty"', array(':item_id' => $this->temp_id));

        /**
         * Если передан RealtyAddress в массиве POST, заполняем атрибуты модели
         */
        if (isset($_POST['RealtyAddress'])) {
            $realty = $this->addressTable;
            if (!$realty) {
                $realty = new RealtyAddress();
            }

            $realty->attributes = $_POST['RealtyAddress'];
            $realty['realty_id'] = $this->id;

            /**
             * В этом случае, адрес не передается из формы, а заполняется в контроллере
             * Используем для присваивания виртуальный атрибут
             */
            if(Yii::app()->settings->get(Settings::GENERAL, 'ad_creation') && !$realty->street){
                    $realty->street = $this->addressStreet;
            }

            //записать в лог дамп атрибутов
            Yii::log(CVarDumper::dumpAsString($realty->attributes, 10), "error");

            //Если не удалось сохранить модель Realty, записать ошибки в лог
            if (!$realty->save(false)) {
                Yii::log(CHtml::errorSummary($realty), "error");
                Yii::log(CVarDumper::dumpAsString($_POST['RealtyAddress'], 10), "error");
                Yii::log(CVarDumper::dumpAsString($realty->attributes, 10), "error");
            }
        }

        /**
         * Если передан RealtyDetailedDescription в массиве POST, заполняем атрибуты модели
         */
        if (isset($_POST['RealtyDetailedDescription'])) {
            //echo CVarDumper::dump($this->realtyDetailed, 10, true);exit;
            $realtyDetailed = $this->realtyDetailed;
            if (!$realtyDetailed) {
                $realtyDetailed = new RealtyDetailedDescription();
            }
            //очистка
            $space_conditions=$realtyDetailed->space_conditions;
            $realtyDetailed->attributes = (new RealtyDetailedDescription())->attributes;
            $realtyDetailed['realty_id'] = $this->id;
            $realtyDetailed['space_conditions'] = $space_conditions;

//            $realtyDetailed->unsetAttributes(
//                array(
//                    'parcel_size_unit',
//                    'parcel_size',
//                    'space_size_units',
//                    'total_space_size'
//                )
//            );
            $realtyDetailed->attributes = $_POST['RealtyDetailedDescription'];

            //echo CVarDumper::dump($realtyDetailed->attributes, 10, true);exit;
            //Если не найден ключ type, присвоить значение realty type
            if(!isset($_POST['RealtyDetailedDescription']['type'])){
                $realtyDetailed->type = $this->type;
            }
            switch ($this->type) {
                case 'apartments':
                    $realtyDetailed->scenario = 'apartments_without_integer_required';
                    break;
                case 'estate':
                    $realtyDetailed->scenario = 'estate_without_integer_required';
                    break;
                case 'land_pot':
                    $realtyDetailed->scenario = 'land_plot_without_integer_required';
                    if (!$realtyDetailed->living_space_size) {
                        $realtyDetailed->living_space_size = 0;
                    }
                    break;
                case 'commercial':
                    $realtyDetailed->scenario = 'commercial_without_integer_required';
                    break;
            }

            $realtyDetailed['realty_id'] = $this->id;

            if ($realtyDetailed->save()) {
                //обновить значение space_sq_meters
                $curRealty = Realty::model()->findByPk($this->id);
                $curRealty->space_sq_meters = $this->getSqMeters($realtyDetailed);
                $curRealty->saveAttributes(array('space_sq_meters'));
            } else {
                Yii::log(CHtml::errorSummary($realtyDetailed), "error");
            }
        }

        if (isset($_POST['Realty']['realtyTags'])) {
            $this->realtyTags = $_POST['Realty']['realtyTags'];
            $tagsConnect_id = array_keys($this->getTagsChecked());
            foreach ($this->realtyTags as $key => $value) {
                // если галочка установлена
                if ($value) {
                    if (!in_array($key, $tagsConnect_id)){
                        $newtag = new RealtyTagsConnection();
                        $newtag->tag_id = $key;
                        $newtag->realty_id = $this->id;
                        $newtag->save();
                    }
                }
                // если галочка убрана
                elseif (in_array($key, $tagsConnect_id)) {
                    $deletetag = RealtyTagsConnection::model()->findByPk(['tag_id' => $key, 'realty_id' => $this->id]);
                    $deletetag->delete();
                }
            }
        }

        return parent::afterSave();
    }

    /**
     * Возвращает значение площади в кв. метрах
     * @param $realtyDetailed
     * @return float|int
     */
    private function getSqMeters($realtyDetailed)
    {
        if ($realtyDetailed->parcel_size_unit == RealtyDetailedDescription::ARE) {
            return $realtyDetailed->parcel_size * 4046.86;
        } elseif ($realtyDetailed->parcel_size_unit == RealtyDetailedDescription::HECTARE) {
            return $realtyDetailed->parcel_size * 10000;
        } else {
            return $realtyDetailed->total_space_size;
        }
    }

    public function getMaxSpaceSize()
    {
        $realtyDetailed = $this->realtyDetailed;
        if ($realtyDetailed) {
            $size = 0;
            if ($this->type == self::ESTATE){
                return ['size' => $realtyDetailed->total_space_size, 'size_unit' => $realtyDetailed->space_size_units ? $realtyDetailed->getSpaseSizeUnitView($realtyDetailed->space_size_units) : ''];
            }

            if ($realtyDetailed->parcel_size_unit == RealtyDetailedDescription::ARE) {
                $size = $realtyDetailed->parcel_size * 4046.86;
            } elseif ($realtyDetailed->parcel_size_unit == RealtyDetailedDescription::HECTARE) {
                $size = $realtyDetailed->parcel_size * 10000;
            }
            $res = MAX($size, $realtyDetailed->living_space_size, $realtyDetailed->total_space_size);
            if ($res == $size) {
                return ['size' => $realtyDetailed->parcel_size, 'size_unit' => $realtyDetailed->parcel_size_unit ? $realtyDetailed->getParcelSizeUnit($realtyDetailed->parcel_size_unit) : ''];
            } else {
                return ['size' => $res, 'size_unit' => $realtyDetailed->space_size_units ? $realtyDetailed->getSpaseSizeUnitView($realtyDetailed->space_size_units) : ''];
            }
        }
        return [];
    }

    public function getTagsChecked()
    {
        $res = [];
        foreach ($this->tagsConnect as $value){
            $res[$value->tag_id] = 1;
        }

        return $res;
    }

    /**
     * Генерирует временны токен
     * @return int|string
     */
    public function getTempId()
    {
        if ($this->id) {
            return $this->id;
        } elseif ($this->temp_id) {
            return $this->temp_id;
        } elseif (empty($this->id) && empty($this->temp_id)) {
            $this->temp_id = YHelper::generateStr(32);
            return $this->temp_id;
        }
    }

    public static function getClassName()
    {
        return strtolower(static::class);
    }
}
