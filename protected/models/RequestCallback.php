<?php

/**
 * This is the model class for table "request_callback".
 *
 * The followings are the available columns in table 'request_callback':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $comment
 * @property string $created_at
 */
class RequestCallback extends CActiveRecord
{
    public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request_callback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, phone, comment', 'required'),
			array('comment', 'length', 'max'=>1200),
			array('name, phone', 'length', 'max'=>255),
			array('created_at', 'safe'),
            //array('verifyCode', 'required', 'on'=>'create'),
            array('verifyCode', 'ext.yiiReCaptcha.ReCaptchaValidator', 'on'=>'create'),
			array('id, name, phone, comment, created_at', 'safe', 'on'=>'search'),
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

    public function afterSave()
    {
        if($this->isNewRecord){
            $brokers = User::model()->findAllByAttributes(array(
                'role'=>User::BROCKER
            ));

            Yii::app()->email->requestCallback($this->name, $this->phone, $this->comment, $brokers);
        }
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
			'name' => Yii::t('BackendModule.backend', 'Имя'),
			'phone' => Yii::t('BackendModule.backend', 'Телефон'),
			'comment' => Yii::t('BackendModule.backend', 'Комментарий'),
			'created_at' => Yii::t('BackendModule.backend', 'Дата отправки'),
            'verifyCode'=>Yii::t('BackendModule.backend', 'Код проверки'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('comment',$this->comment);
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
	 * @return RequestCallback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
