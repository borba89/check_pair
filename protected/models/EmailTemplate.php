<?php

/**
 * This is the model class for table "email_template".
 *
 * The followings are the available columns in table 'email_template':
 * @property integer $id
 * @property string $name
 * @property string $variables
 * @property string $subject_ru
 * @property string $subject_ro
 * @property string $subject_en
 * @property string $message_ru
 * @property string $message_ro
 * @property string $message_en
 * @property integer $status
 */
class EmailTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, subject_ru, subject_ro, subject_en, message_ru, message_ro, message_en', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
            array('variables', 'default', 'value'=>''),
			array('name, variables, subject_ru, subject_ro, subject_en', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, variables, subject_ru, subject_ro, subject_en, message_ru, message_ro, message_en, status', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('BackendModule.backend', 'Имя шаблона'),
			'variables' => Yii::t('BackendModule.backend','Переменные'),
			'subject_ru' => Yii::t('BackendModule.backend','Тема Ru'),
			'subject_ro' => Yii::t('BackendModule.backend','Тема Ro'),
			'subject_en' => Yii::t('BackendModule.backend','Тема En'),
			'message_ru' => Yii::t('BackendModule.backend','Тело письма Ru'),
			'message_ro' => Yii::t('BackendModule.backend','Тело письма Ro'),
			'message_en' => Yii::t('BackendModule.backend','Тело письма En'),
			'status' => Yii::t('BackendModule.backend','Вкл'),
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
		$criteria->compare('variables',$this->variables,true);
		$criteria->compare('subject_ru',$this->subject_ru,true);
		$criteria->compare('subject_ro',$this->subject_ro,true);
		$criteria->compare('subject_en',$this->subject_en,true);
		$criteria->compare('message_ru',$this->message_ru,true);
		$criteria->compare('message_ro',$this->message_ro,true);
		$criteria->compare('message_en',$this->message_en,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getSubject()
    {
        return $this->{'subject_'.Yii::app()->language};
    }

    public function getMessage()
    {
        return $this->{'message_'.Yii::app()->language};
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmailTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
