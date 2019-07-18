<?php

/**
 * This is the model class for table "city_district".
 *
 * The followings are the available columns in table 'city_district':
 * @property integer $id
 * @property integer $city_id
 * @property string $district_en
 * @property string $district_ro
 * @property string $district_ru
 * @property integer $suburb
 *
 * The followings are the available model relations:
 * @property City $city
 */
class CityDistrict extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'city_district';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, district_en, district_ro, district_ru', 'required'),
			array('city_id, suburb', 'numerical', 'integerOnly'=>true),
			array('district', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, city_id, district', 'safe', 'on'=>'search'),
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
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

    public function scopes()
    {
        return array(
            'withoutSuburb'=>array(
                'condition'=>'suburb=0',
            ),
            'withSuburb'=>array(
                'condition'=>'suburb=1',
            ),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'city_id' => 'Город',
			'district_en' => 'Район EN',
            'district_ro' => 'Район RO',
            'district_ru' => 'Район RU',
            'suburb'=>'Пригород'
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
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('district',$this->district,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>100,
            ),
		));
	}

    public function getDistrict()
    {
        return $this->{'district_'.Yii::app()->language};
    }

    public static function getCities()
    {
        return CHtml::listData(City::model()->findAllByAttributes(array('geonameid'=>618426)), 'geonameid', 'cityName');
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CityDistrict the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
