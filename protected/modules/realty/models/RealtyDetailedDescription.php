<?php

/**
 * This is the model class for table "realty_detailed_description".
 *
 * The followings are the available columns in table 'realty_detailed_description':
 * @property integer $id
 * @property string $type
 * @property integer $realty_id
 * @property integer $parcel_size
 * @property string $parcel_size_unit
 * @property integer $living_space_size
 * @property integer $total_space_size
 * @property string $space_size_units
 * @property integer $number_of_floors
 * @property string $space_conditions
 * @property integer $newly_built
 * @property integer $floor
 * @property integer $rooms
 * @property string $project_type
 * @property integer $building_type
 * @property string $apartment_position
 * @property integer $num_balcony
 * @property integer $bedrooms
 *
 * @property Realty $realty
 */
class RealtyDetailedDescription extends CActiveRecord
{
    public $parcelInSqMeters;

    const ARE = 'are';
    const HECTARE = 'hectare';

    const SQUARE_METERS = 'square meters';
    const METERS = 'meters';

    const GRAY = 'gray';
    const WHITE = 'white';
    const MINOR  = 'minor';
    const INDIVIDUAL = 'individual';
    const NEEDED = 'needed';
    const EURO = 'euro';
    const NO_RENOVATION = 'no_renovation';

    /**
     * Подтипы готового бизнеса
     */
    const SUBTYPE_CATERING = 'catering';
    const SUBTYPE_SERVICES = 'services';
    const SUBTYPE_COMMERCIAL = 'commercial';
    const SUBTYPE_HOTELS = 'hotels';
    const SUBTYPE_TRANSPORT = 'transport';
    const SUBTYPE_MANUFACTURE = 'manufacture';
    const SUBTYPE_AGRICULTURAL = 'agricultural';
    const SUBTYPE_OTHER = 'other';

    /**
     * Подтипы коммерческих площадей
     */
    const TYPE_COMMERCIAL_CATERING = 'catering';
    const TYPE_COMMERCIAL_OFFICE = 'office';
    const TYPE_COMMERCIAL_WAREHOUSE = 'warehouse';
    const TYPE_COMMERCIAL_MANUFACTURE = 'manufacture';
    const TYPE_COMMERCIAL_COMMERCIAL = 'commercial';

    const TYPE_LAND_AGRICULTURAL = 'agricultural';
    const TYPE_LAND_BUILD = 'build';

    const POSITION_CORNER_ONE_SIDE = 'corner_one_sided';
    const POSITION_MIDDLE_ONE_SIDE = 'middle_one_sided';
    const POSITION_CORNER_BILATERAL = 'corner_bilateral';
    const POSITION_MIDDLE_BILATERAL = 'middle_bilateral';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'realty_detailed_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('parcel_size, parcel_size_unit, living_space_size, total_space_size, space_size_units, number_of_floors, space_conditions, bedrooms', 'required', 'on' => 'estate_step1'),
            array('parcel_size_unit, space_size_units, space_conditions', 'required', 'on' => 'estate_without_integer_required'),
            array('newly_built, total_space_size, space_size_units, floor, rooms, space_conditions, apartment_position, project_type, building_type', 'required', 'on' => 'apartments_step1'),
            array('newly_built, space_size_units, space_conditions, apartment_position, building_type', 'required', 'on' => 'apartments_without_integer_required'),
            array('total_space_size, space_size_units', 'required', 'on' => 'office_step1'),
            array('parcel_size, parcel_size_unit, total_space_size, space_size_units', 'required', 'on' => 'industrial_step1'),
            array('total_space_size, space_size_units', 'required', 'on' => 'warehouse_step1'),
            array('total_space_size, space_size_units', 'required', 'on' => 'commercial_step1'),
            array('space_size_units', 'required', 'on' => 'commercial_without_integer_required'),
            array('parcel_size, parcel_size_unit', 'required', 'on' => 'land_plot_step1'),
            array('parcel_size_unit', 'required', 'on' => 'land_plot_without_integer_required'),
			array('realty_id, parcel_size, living_space_size, total_space_size, number_of_floors, newly_built, floor, rooms, num_balcony, bedrooms, project_type', 'numerical', 'integerOnly'=>true),
			array('type, apartment_position, building_type', 'length', 'max'=>255),
			array('parcel_size_unit', 'length', 'max'=>7),
			array('space_size_units', 'length', 'max'=>13),
			array('space_conditions', 'length', 'max'=>14),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, realty_id, parcel_size, parcel_size_unit, living_space_size, total_space_size, space_size_units, number_of_floors, space_conditions, newly_built, floor, rooms, bedrooms, project_type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'realty' => array(self::BELONGS_TO, 'Realty', 'realty_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => Yii::t("RealtyModule.realty", 'Тип недвижимости'),
			'realty_id' => 'Realty',
			'parcel_size' => Yii::t("RealtyModule.realty", 'Площадь земельного участка'),
			'parcel_size_unit' => Yii::t("RealtyModule.realty", 'Единицы измерения площади земельного участка'),
			'living_space_size' => Yii::t("RealtyModule.realty", 'Площадь жилых помещений'),
			'total_space_size' => Yii::t("RealtyModule.realty", 'Общая площадь помещений'),
			'space_size_units' => Yii::t("RealtyModule.realty", 'Единицы измерения площади помещений'),
			'number_of_floors' => Yii::t("RealtyModule.realty", 'Количество этажей дома'),
			'space_conditions' => Yii::t("RealtyModule.realty", 'Состояние помещений'),
			'newly_built' => Yii::t("RealtyModule.realty", 'Является ли объект недвижимости новостроем'),
			'floor' => Yii::t("RealtyModule.realty", 'Этаж, где расположена квартира'),
			'rooms' => Yii::t("RealtyModule.realty", 'Количество комнат'),
            'apartment_position' => Yii::t("RealtyModule.realty", 'Расположение квартиры в доме'),
            'project_type' => Yii::t("RealtyModule.realty", 'Строительная серия дома'),
            'building_type' => Yii::t("RealtyModule.realty", 'Тип строения'),
            'num_balcony'=> Yii::t("RealtyModule.realty", 'Количество балконов'),
            'bedrooms'=> Yii::t("RealtyModule.realty", 'Количество спален'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('realty_id',$this->realty_id);
		$criteria->compare('parcel_size',$this->parcel_size);
		$criteria->compare('parcel_size_unit',$this->parcel_size_unit,true);
		$criteria->compare('living_space_size',$this->living_space_size);
		$criteria->compare('total_space_size',$this->total_space_size);
		$criteria->compare('space_size_units',$this->space_size_units,true);
		$criteria->compare('number_of_floors',$this->number_of_floors);
		$criteria->compare('space_conditions',$this->space_conditions,true);
		$criteria->compare('newly_built',$this->newly_built);
		$criteria->compare('floor',$this->floor);
		$criteria->compare('rooms',$this->rooms);
		$criteria->compare('bedrooms',$this->bedrooms);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RealtyDetailedDescription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Возвращает массив единиц измерения площади
     * @return mixed
     */
    public function getParcelSizeUnit($value = null)
    {
        $retArr[self::ARE] = Yii::t("RealtyModule.realty", 'ар');
        $retArr[self::HECTARE] = Yii::t("RealtyModule.realty", 'га');

        if ($value) {
            return $retArr[$value];
        }

        return $retArr;
    }

    /**
     * Для формы, в качестве списка выбора
     * @param null $value
     * @return mixed
     */
    public function getSpaseSizeUnits($value = null)
    {
        $retArr[self::SQUARE_METERS] = Yii::t("RealtyModule.realty", 'м2');
        //$retArr[self::METERS] = Yii::t("RealtyModule.realty", 'м.');

        if ($value) {
            return $retArr[$value];
        }
        return $retArr;
    }

    public function getParcelSizeUnits($value = null)
    {
        $retArr = $this->getParcelSizeUnit();

        if ($value) {
            return isset($retArr[$value])?$retArr[$value]:$value;
        }

        return $retArr;
    }

    /**
     * Вывод единиц измерения для представления
     * @param null $value
     * @return mixed
     */
    public function getSpaseSizeUnitView($value = null)
    {
        $retArr[self::SQUARE_METERS] = Yii::t("RealtyModule.realty", 'м<sup>2</sup>');
        //$retArr[self::METERS] = Yii::t("RealtyModule.realty", 'м.');

        if ($value) {
            return $retArr[$value];
        }

        return $retArr;
    }

    /**
     * Возвращает массив состояний недвижимости
     * @param null $value
     * @return mixed
     */
    public function getSpaseConditions($value = null)
    {
        $retArr[self::GRAY] = Yii::t("RealtyModule.realty", '"Серый" вариант');
        $retArr[self::WHITE] = Yii::t("RealtyModule.realty", '"Белый" вариант');
        $retArr[self::EURO] = Yii::t("RealtyModule.realty", 'Евроремонт');
        $retArr[self::MINOR] = Yii::t("RealtyModule.realty", 'Косметический ремонт');
        $retArr[self::INDIVIDUAL] = Yii::t("RealtyModule.realty", 'Индивидуальный дизайн');
        $retArr[self::NEEDED] = Yii::t("RealtyModule.realty", 'Нуждается в ремонте');
        $retArr[self::NO_RENOVATION] = Yii::t("RealtyModule.realty", 'Без ремонта');

        if ($value) {
            return $retArr[$value];
        }

        return $retArr;
    }

    /**
     * Вернуть массив подтипов коммерческой недвижимости
     * @return array
     */
    public function getCommercialTypes()
    {
        return array(
            self::TYPE_COMMERCIAL_CATERING => Yii::t("RealtyModule.realty", 'Кафе / бар / ресторан'),
            self::TYPE_COMMERCIAL_OFFICE => Yii::t("RealtyModule.realty", 'Офис'),
            self::TYPE_COMMERCIAL_WAREHOUSE => Yii::t("RealtyModule.realty", 'Склад'),
            self::TYPE_COMMERCIAL_MANUFACTURE => Yii::t("RealtyModule.realty", 'Производство'),
            self::TYPE_COMMERCIAL_COMMERCIAL => Yii::t("RealtyModule.realty", 'Торговля'),
        );
    }

    /**
     * Вернуть человеко-понятное значение коммерческого подтипа
     * @param $value
     * @return mixed
     */
    public function getCommercialType($value)
    {
        $types = $this->getCommercialTypes();
        return $types[$value];
    }

    /**
     * Подтипы готового бизнеса
     * @param null $value
     * @return mixed
     */
    public function getSubtypes($value = null)
    {
        $retArr[self::SUBTYPE_CATERING] = Yii::t("RealtyModule.realty", 'Общественное питание');
        $retArr[self::SUBTYPE_SERVICES] = Yii::t("RealtyModule.realty", 'Сфера услуг');
        $retArr[self::SUBTYPE_COMMERCIAL] = Yii::t("RealtyModule.realty", 'Коммерция');
        $retArr[self::SUBTYPE_HOTELS] = Yii::t("RealtyModule.realty", 'Гостиничные услуги, туризм');
        $retArr[self::SUBTYPE_TRANSPORT] = Yii::t("RealtyModule.realty", 'Транспорт');
        $retArr[self::SUBTYPE_MANUFACTURE] = Yii::t("RealtyModule.realty", 'Производство');
        $retArr[self::SUBTYPE_AGRICULTURAL] = Yii::t("RealtyModule.realty", 'Сельское хозяйство / животноводство');
        $retArr[self::SUBTYPE_OTHER] = Yii::t("RealtyModule.realty", 'Другое');

        if ($value) {
            return $retArr[$value];
        }

        return $retArr;
    }

    /**
     * Вернуть массив подтипов земельного участка
     * @return array
     */
    public function getLandTypes($value = null)
    {
            $retArr[self::TYPE_LAND_AGRICULTURAL] = Yii::t("RealtyModule.realty", 'Под сельское хозяйство');
            $retArr[self::TYPE_LAND_BUILD] = Yii::t("RealtyModule.realty", 'Под застройку');

        if ($value) {
            return $retArr[$value];
        }

        return $retArr;
    }

    /**
     * Вернуть человеко-понятное значение подтипа земельного участка
     * @param $value
     * @return mixed
     */
    public function getLandType($value)
    {
        $types = $this->getLandTypes();
        return $types[$value];
    }

    /**
     * Массив расположение квартиры в доме
     * @return array
     */
    public function getPositions()
    {
        return array(
            self::POSITION_CORNER_ONE_SIDE => Yii::t("RealtyModule.realty", 'Угловая одностронняя'),
            self::POSITION_MIDDLE_ONE_SIDE => Yii::t("RealtyModule.realty", 'Центральная односторонняя'),
            self::POSITION_CORNER_BILATERAL => Yii::t("RealtyModule.realty", 'Угловая двусторонняя'),
            self::POSITION_MIDDLE_BILATERAL => Yii::t("RealtyModule.realty", 'Центральная двусторонняя'),
        );
    }

    /**
     * Человекопнятное значение расположения квартиры в доме
     * @param $value
     * @return mixed
     */
    public function getPosition($value)
    {
        $pos = $this->getPositions();
        return $pos[$value];
    }

    /**
     * Возвращает человеко-понятное значение типа строения
     * @return string
     */
    public function newlyBuildLabel()
    {
        if ($this->newly_built) {
            return Yii::t("RealtyModule.realty", 'Новострой');
        } else {
            return Yii::t("RealtyModule.realty", 'Вторичка');
        }
    }

    /**
     * Возвращает дополнительные атрибуты для вывода при детальном просмторе view
     * @return array
     */
    public function viewAdditional()
    {
        $additional = array();
	    foreach ($this->rules() as $rule) {
	        if (isset($rule['on']) && $rule['on'] == $this->realty->type.'_step1') {
                $additional = explode(',', $rule[0]);
            }
        }

        if ($additional) {
            //echo CVarDumper::dump($additional,10,true);exit;
            $attrArr = array();
            foreach ($additional as $attr) {
                $attr = trim($attr);
                $attrArr[] = array(
                    'name' => $attr,
                    'label' => $this->getAttributeLabel($attr),
                    'value' => $this->{$attr},
                    'type' => $this->getFormatAttr($attr),
                );
            }
            $additional = $attrArr;
        }
        //echo CVarDumper::dump($additional,10,true);exit;
        return $additional;
    }

    /**
     * Вернуть подтип в зависимости от типа
     * @param $type
     * @return mixed
     */
    public function previewSubtype($type, $subtype)
    {
        switch ($type){
            case 'business':
                return $this->getSubtypes($subtype);
            case 'commercial':
                return $this->getCommercialType($subtype);
            case 'land_pot':
                return $this->getLandType($subtype);
            case Realty::ESTATE:
                return Realty::model()->getRealtyType($type);
            case Realty::APARTMENTS:
                return Realty::model()->getRealtyType($type);
            default:
                return null;//$this->getSubtypes($subtype);
        }
    }

    /**
     * Тип строения (кирпич, бетон, дерево ...)
     * @return string
     */
    public function getBuildingType()
    {
        $result = BuildingTypes::model()->findByAttributes(array(
            'code'=>$this->building_type
        ));

        if($result){
            return Yii::t("RealtyModule.realty", $result->name);
        }else{
            return 'N/A';
        }
    }

    public function getProjectType()
    {
        $result = BuildingProject::model()->findByPk($this->project_type);

        if($result){
            return $result->{'title_'.Yii::app()->language};
        }else{
            return 'N/A';
        }
    }

    /**
     * @param $attr
     * @return string
     */
    private function getFormatAttr($attr)
    {
        $ret = 'raw';

        if ($attr == 'newly_built') {
            $ret = 'boolean';
        } elseif ($attr == 'space_conditions') {
            $ret = 'spaseConditions';
        } elseif ($attr == 'space_size_units') {
            $ret = 'spaseSizeUnits';
        }

        return $ret;
    }

    public function getSubtypesFromValue($value)
    {
        switch ($value){
            case Realty::APARTMENTS:
                break;
            case Realty::ESTATE:
                break;
            case Realty::BUSINESS:
                break;
            case Realty::COMMERTIAL:
                break;
            case Realty::LAND_POT:
                break;
        }
    }
}
