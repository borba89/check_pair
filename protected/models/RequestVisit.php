<?php

/**
 * This is the model class for table "request_visit".
 *
 * The followings are the available columns in table 'request_visit':
 * @property integer $id
 * @property integer $realty_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $created_at
 */
class RequestVisit extends CActiveRecord
{
    public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request_visit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('realty_id, name, phone, email', 'required'),
			array('realty_id, name, phone', 'required'),
			array('realty_id', 'numerical', 'integerOnly'=>true),
			array('name, phone, email', 'length', 'max'=>255),
			array('message, created_at', 'safe'),
            //array('verifyCode', 'required', 'on'=>'create'),
            array('verifyCode', 'ext.yiiReCaptcha.ReCaptchaValidator', 'on'=>'create'),
			array('id, realty_id, name, phone, email, message, created_at', 'safe', 'on'=>'search'),
		);
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'realty'=>array(self::BELONGS_TO, 'Realty', 'realty_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'realty_id' => Yii::t('BackendModule.backend', 'Недвижимость'),
            'name' => Yii::t('BackendModule.backend', 'Имя'),
            'phone' => Yii::t('BackendModule.backend', 'Телефон'),
            'message' => Yii::t('BackendModule.backend', 'Комментарий'),
            'created_at' => Yii::t('BackendModule.backend', 'Дата отправки'),
            'verifyCode'=>Yii::t('BackendModule.backend', 'Код проверки'),
		);
	}

    public function afterSave()
    {
        if($this->isNewRecord){
            if($this->realty->broker_id){
                $broker = User::model()->findByPk($this->realty->broker_id);
            }

            if(isset($broker)){
                $broker_email = $broker->email;
            }else{
                $broker_email = null;
            }

            Yii::app()->email->requestVisit($this->name, $this->phone, $this->message, $this->realty->offer->title, $this->realty->getUrl(), $broker_email);
        }
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->order = 'created_at DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestVisit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
