<?php

/**
 * This is the model class for table "auction".
 *
 * The followings are the available columns in table 'auction':
 * @property integer $id
 * @property integer $offer_id
 * @property integer $start_bids
 * @property string $end_date
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property RealtyOffer $offer
 * @property Bids[] $bids
 */
class Auction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offer_id', 'required'),
			array('offer_id, start_bids, status', 'numerical', 'integerOnly'=>true),
			array('end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, offer_id, start_bids, end_date, status', 'safe', 'on'=>'search'),
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
			'offer' => array(self::BELONGS_TO, 'RealtyOffer', 'offer_id'),
			'bids' => array(self::HAS_MANY, 'Bids', 'auction_id'),
            'countBids' => array(self::STAT, 'Bids', 'auction_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'offer_id' => Yii::t('BackendModule.backend','Объявление'),
			'start_bids' => Yii::t('BackendModule.backend','Начальное кол-во заявок'),
			'end_date' => Yii::t('BackendModule.backend','Окончание'),
			'status' => Yii::t('BackendModule.backend','Активен'),
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
		$criteria->compare('offer_id',$this->offer_id);
		$criteria->compare('start_bids',$this->start_bids);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Auction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
