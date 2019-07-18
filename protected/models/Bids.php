<?php

/**
 * This is the model class for table "auction_bids".
 *
 * The followings are the available columns in table 'auction_bids':
 * @property integer $id
 * @property integer $auction_id
 * @property string $name
 * @property string $phone
 * @property string $bid
 * @property string $created_at
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Auction $auction
 */
class Bids extends CActiveRecord
{
    public $verifyCode;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auction_bids';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('auction_id, name, phone, bid', 'required'),
			array('auction_id, status', 'numerical', 'integerOnly'=>true),
			array('name, phone, bid', 'length', 'max'=>255),
			array('created_at', 'safe'),
            //array('verifyCode', 'required', 'on'=>'create'),
            array('verifyCode', 'ext.yiiReCaptcha.ReCaptchaValidator', 'on'=>'create'),
			array('id, auction_id, name, phone, bid, created_at, status', 'safe', 'on'=>'search'),
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
			'auction' => array(self::BELONGS_TO, 'Auction', 'auction_id'),
		);
	}

	public function afterSave()
    {
        if($this->isNewRecord){
            //отправить письмо риэлтору или на корпоративный адрес
            $realty = $this->auction->offer->realty;

            Yii::app()->email->setBid($this->name, $this->phone, $this->bid, $realty->offer->currency, $realty->url, $this->auction->offer);
        }
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'auction_id' => 'Auction',
			'name' => 'Name',
			'phone' => 'Phone',
			'bid' => 'Bid',
			'created_at' => 'Created At',
			'status' => 'Status',
            'verifyCode'=>'Код проверки'
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
		$criteria->compare('auction_id',$this->auction_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('bid',$this->bid,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bids the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
