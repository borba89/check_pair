<?php

/**
 * This is the model class for table "about_employees".
 *
 * The followings are the available columns in table 'about_employees':
 * @property integer $id
 * @property string $title_en
 * @property string $title_ro
 * @property string $title_ru
 * @property string $subtitle_en
 * @property string $subtitle_ro
 * @property string $subtitle_ru
 * @property string $text_en
 * @property string $text_ro
 * @property string $text_ru
 * @property string $image
 */
class AboutEmployees extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'about_employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_en, title_ro, title_ru, subtitle_en, subtitle_ro, subtitle_ru, text_en, text_ro, text_ru', 'safe'),
            array('image', 'file', 'types'=>'png, jpg, jpeg, gif, swf', 'safe' => false, 'allowEmpty'=>true),
			array('id, title_en, title_ro, title_ru, subtitle_en, subtitle_ro, subtitle_ru, text_en, text_ro, text_ru, image', 'safe', 'on'=>'search'),
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
			'title_en' => 'Title En',
			'title_ro' => 'Title Ro',
			'title_ru' => 'Title Ru',
			'subtitle_en' => 'Subtitle En',
			'subtitle_ro' => 'Subtitle Ro',
			'subtitle_ru' => 'Subtitle Ru',
			'text_en' => 'Text En',
			'text_ro' => 'Text Ro',
			'text_ru' => 'Text Ru',
			'image' => 'Image',
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
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('subtitle_en',$this->subtitle_en,true);
		$criteria->compare('subtitle_ro',$this->subtitle_ro,true);
		$criteria->compare('subtitle_ru',$this->subtitle_ru,true);
		$criteria->compare('text_en',$this->text_en,true);
		$criteria->compare('text_ro',$this->text_ro,true);
		$criteria->compare('text_ru',$this->text_ru,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getSubtitle()
    {
        return $this->{'subtitle_'.Yii::app()->language};
    }

    public function getText()
    {
        return $this->{'text_'.Yii::app()->language};
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AboutEmployees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
