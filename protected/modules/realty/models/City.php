<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $geonameid
 * @property string $city_name_UTF8
 * @property string $city_name_ASCII
 * @property string $city_name_ru
 * @property string $country
 *
 * The followings are the available model relations:
 * @property Country $country0
 * @property CityDistrict[] $cityDistricts
 * @property RealtyAddress[] $realtyAddresses
 */
class City extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_name_UTF8, city_name_ASCII, city_name_ru, country', 'required'),
			array('city_name_UTF8, city_name_ASCII, city_name_ru', 'length', 'max'=>255),
			array('country', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('geonameid, city_name_UTF8, city_name_ASCII, city_name_ru, country', 'safe', 'on'=>'search'),
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
			'country0' => array(self::BELONGS_TO, 'Country', 'country'),
			'cityDistricts' => array(self::HAS_MANY, 'CityDistrict', 'city_id'),
			'realtyAddresses' => array(self::HAS_MANY, 'RealtyAddress', 'city'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'geonameid' => 'Geonameid',
			'city_name_UTF8' => 'City Name Utf8',
			'city_name_ASCII' => 'City Name Ascii',
			'city_name_ru' => 'City Name Ru',
			'country' => 'Country',
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

		$criteria->compare('geonameid',$this->geonameid);
		$criteria->compare('city_name_UTF8',$this->city_name_UTF8,true);
		$criteria->compare('city_name_ASCII',$this->city_name_ASCII,true);
        $criteria->compare('city_name_ru',$this->city_name_ru,true);
		$criteria->compare('country',$this->country,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getCityName()
    {
        if (Yii::app()->language == 'ru') {
            return $this->city_name_ru;
        }

        return $this->city_name_ASCII;
    }
}
