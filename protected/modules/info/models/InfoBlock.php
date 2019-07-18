<?php

/**
 * This is the model class for table "info_block".
 *
 * The followings are the available columns in table 'info_block':
 * @property integer $id
 * @property string $image
 * @property string $title_ru
 * @property string $title_ro
 * @property integer $title_en
 * @property string $text_ru
 * @property string $text_ro
 * @property string $text_en
 */
class InfoBlock extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'info_block';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ru, title_ro, title_en, text_ru, text_ro, text_en', 'required'),
            array('image', 'file', 'types'=>'png, jpg, gif, swf', 'safe' => false, 'allowEmpty'=>true),
			array('title_ru, title_ro, title_en', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_ru, title_ro, title_en, text_ru, text_ro, text_en', 'safe', 'on'=>'search'),
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
			'image' => 'Image',
			'title_ru' => 'Название на русском',
			'title_ro' => 'Название на румынском',
			'title_en' => 'Название на английском',
			'text_ru' => 'Описание на русском',
			'text_ro' => 'Описание на румынском',
			'text_en' => 'Описание на английском',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_en',$this->title_en);
		$criteria->compare('text_ru',$this->text_ru,true);
		$criteria->compare('text_ro',$this->text_ro,true);
		$criteria->compare('text_en',$this->text_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfoBlock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getText()
    {
        return $this->{'text_'.Yii::app()->language};
    }

    public function getMiddleImage($key) {
        $imageArr = array(
            'img/bg/Accounts.jpg',
            'img/bg/dom.jpg',
            'img/bg/1138.jpg',
            'img/bg/111.jpg',
            'img/bg/7-business.jpg',
        );

        if ($key == 1) {
            return current($imageArr);
        }

        $ret = next($imageArr);
        if (!$ret) {
            $ret = reset($imageArr);
        }

        return $ret;
    }
}
