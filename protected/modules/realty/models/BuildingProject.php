<?php
Yii::import('realty.models.RealtyDetailedDescription');
/**
 * This is the model class for table "building_project".
 *
 * The followings are the available columns in table 'building_project':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ro
 * @property string $title_en
 */
class BuildingProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'building_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ru, title_ro, title_en', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_ru, title_ro, title_en', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'title_ru' => Yii::t("OfferModule.offer", 'Заголовок на русском'),
            'title_ro' => Yii::t("OfferModule.offer", 'Заголовок на молдавском'),
            'title_en' => Yii::t("OfferModule.offer", 'Заголовок на английском'),
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
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_en',$this->title_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public static function getAllProjectTypes()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'title_'. Yii::app()->language .' ASC';

        return CHtml::listData(self::model()->findAll($criteria), 'id', 'title_'.Yii::app()->language);

    }

    public function afterDelete()
    {
        RealtyDetailedDescription::model()->updateAll(array('project_type' => 0),'project_type = :item_id', array(':item_id' => $this->id));
        return parent::afterDelete();
    }

    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BuildingProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
