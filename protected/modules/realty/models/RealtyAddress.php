<?php

/**
 * This is the model class for table "realty_address".
 *
 * The followings are the available columns in table 'realty_address':
 * @property integer $id
 * @property integer $realty_id
 * @property string $country
 * @property integer $province
 * @property integer $city
 * @property string $city_district
 * @property string $street
 *
 * The followings are the available model relations:
 * @property Realty $realty
 * @property Country $country0
 * @property City $city0
 * @property Province $province0
 */
class RealtyAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'realty_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country, city, city_district, street', 'required', 'on' => 'step0, insert, update'),
			array('realty_id, province, city, city_district', 'numerical', 'integerOnly'=>true),
			array('country', 'length', 'max'=>3),
			array('street', 'length', 'max'=>80),
            array('street', 'length', 'max'=>255),
            array('search_string', 'length', 'max'=>400),
            array('coord_url', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, realty_id, country, province, city, coord_url,city_district, street, search_string','safe', 'on'=>'search'),
		);
	}

    public function beforeSave()
    {
        $this->search_string = $this->getCountries($this->country).', '.$this->getCitiesAndSuburbs($this->city).', '.$this->getAllDistrict($this->city_district).', '.$this->street;
//        $matches = [];
//        preg_match('/src="(.*?)"/', $this->coord_url, $matches);
//        if(isset($matches)) {
//            $this->coord_url = $matches[1];
//        }

        return parent::beforeSave();
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'realty' => array(self::BELONGS_TO, 'Realty', 'realty_id'),
			'country0' => array(self::BELONGS_TO, 'Country', 'country'),
			'city0' => array(self::BELONGS_TO, 'City', 'city'),
			'province0' => array(self::BELONGS_TO, 'Province', 'province'),
            'district' => array(self::BELONGS_TO, 'CityDistrict', 'city_district'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'realty_id' => 'Realty',
			'country' => Yii::t("RealtyModule.realty", 'Страна'),
			'province' => Yii::t("RealtyModule.realty", 'Провинция'),
			'city' => Yii::t("RealtyModule.realty", 'Город'),
			'city_district' => Yii::t("RealtyModule.realty", 'Район'),
			'street' => Yii::t("RealtyModule.realty", 'Улица'),
            'coord_url' => Yii::t("RealtyModule.realty", 'Координаты')
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
		$criteria->compare('realty_id',$this->realty_id);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('city_district',$this->city_district,true);
        $criteria->compare('search_string',$this->search_string,true);
		$criteria->compare('street',$this->street,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RealtyAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getCountries($value = null)
    {
        $countries = Country::model()->findAll('iso = :country', array(':country' => 'MD'));
        if (Yii::app()->language == 'ru') {
            $countries = CHtml::listData($countries, 'iso', 'country_name_ru');
        } else {
            $countries = CHtml::listData($countries, 'iso', 'country_name');
        }

        if ($value) {
            return $countries[$value];
        }

        return $countries;
    }

    public function getCities($value = null)
    {
        $cities = City::model()->findAll('geonameid = :city_id', array(':city_id' => 618426));
        if (Yii::app()->language == 'ru') {
            $cities = CHtml::listData($cities, 'geonameid', 'city_name_ru');
        } else {
            $cities = CHtml::listData($cities, 'geonameid', 'city_name_ASCII');
        }

        if ($value) {
            return $cities[$value];
        }
        return $cities;
    }

    public function getCitiesAndSuburbs($value = null)
    {
        $cities = City::model()->findAll('geonameid = :city_id', array(':city_id' => 618426));
        if (Yii::app()->language == 'ru') {
            $cities = CHtml::listData($cities, 'geonameid', 'city_name_ru');
        } else {
            $cities = CHtml::listData($cities, 'geonameid', 'city_name_ASCII');
        }
        if ($cities) {
        $districts = CityDistrict::model()->withSuburb()->findAll('city_id = :city', array(':city' => 618426));
            if ($districts) {
                $city_suburb = City::model()->findAll('geonameid = :city_id', array(':city_id' => 618427));
                $city_suburb = $city_suburb[0];
                if (Yii::app()->language == 'ru') {
                    $cities[$city_suburb->geonameid] = $city_suburb->city_name_ru;
                } else {
                    $cities[$city_suburb->geonameid] = $city_suburb->city_name_ASCII;
                }
            }
        }
        if ($value) {
            return $cities[$value];
        }
        return $cities;
    }

    /**
     * Вернуть список районов города для выпадающего списка
     * @param null $value
     * @return array|CityDistrict[]|string
     */
    public function getDistrict($value = null)
    {
        if ($this->city) {
            $districts = CityDistrict::model()->withoutSuburb()->findAll('city_id = :city', array(':city' => $this->city));
        } else {
            $districts = CityDistrict::model()->withoutSuburb()->findAll();
        }

        $districts = CHtml::listData($districts, 'id', 'district_'.Yii::app()->language);

        if ($value) {
            return isset($districts[$value]) ? $districts[$value] : 'N/A';
        }

        return $districts;
    }

    public function getAllDistrict($value = null)
    {
        $districts = CityDistrict::model()->findAll();
        $districts = CHtml::listData($districts, 'id', 'district_'.Yii::app()->language);
        if ($value) {
            return isset($districts[$value]) ? $districts[$value] : 'N/A';
        }

        return $districts;
    }


    public function getDistrictSuburbs($city, $value = null)
    {
        if ($city) {
            $districts = CityDistrict::model()->withSuburb()->findAll('city_id = :city', array(':city' => $city));
        } else {
            $districts = CityDistrict::model()->withSuburb()->findAll();
        }

        $districts = CHtml::listData($districts, 'id', 'district_'.Yii::app()->language);

        if ($value) {
            return isset($districts[$value]) ? $districts[$value] : 'N/A';
        }

        return $districts;
    }

    public function getAddress()
    {
		
		return $this->getCountries($this->country)
            .', '. $this->getCities($this->city)
            .', '. $this->getDistrict($this->city_district)
            .', '. $this->street;
	}
	
	public function getShortAddress()
	{
		return $this->getDistric($this->city_district).', '. $this->street;
	}

}
