<?php
Yii::import('realty.models.RealtyTypeTagsConnection');

/**
 * This is the model class for table "realty_tags".
 *
 * The followings are the available columns in table 'realty_tags':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ro
 * @property string $title_en
 *
 * The followings are the available model relations:
 * @property Realty[] $realties
 */
class RealtyTags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'realty_tags';
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
			'realties' => array(self::MANY_MANY, 'Realty', 'realty_tags_connection(tag_id, realty_id)'),
            'realtyTypes' => array(self::HAS_MANY, 'RealtyTypeTagsConnection', 'tag_id'),
		);
//        return $this->hasMany(SQuizQuestion::className(), ['ID_REC' => 'ID_QUESTION'])->via('SQUIZTQs');
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RealtyTags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public static function getAllTags()
    {
        return self::model()->findAll();
    }

    public static function getAllTagsOrderByTitle()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'title_'. Yii::app()->language .' ASC';

        return self::model()->findAll($criteria);
    }

    public static function getTagsByRealtyTypeOrderByTitle($realty_type)
    {
        $criteria = new CDbCriteria();
        $criteria->with = 'realtyTypes';
        $criteria->compare('realtyTypes.realty_type',$realty_type);
        $criteria->order = 't.title_'. Yii::app()->language .' ASC';

        return self::model()->findAll($criteria);
    }

    public function getRealtyTypesChecked()
    {
        $res = [];
        foreach ($this->realtyTypes as $value){
            $res[$value->realty_type] = 1;
        }

        return $res;
    }
}
