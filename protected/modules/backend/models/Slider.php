<?php

/**
 * This is the model class for table "slider".
 *
 * The followings are the available columns in table 'slider':
 * @property integer $id
 * @property string $title_en
 * @property string $title_ro
 * @property string $title_ru
 * @property string $subtitle_en
 * @property string $subtitle_ro
 * @property string $subtitle_ru
 */
class Slider extends CActiveRecord
{
    public $countSlides;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title_en, title_ro, title_ru, subtitle_en, subtitle_ro, subtitle_ru, title', 'required'),
            array('title_en, title_ro, title_ru, title', 'length', 'max'=>64),
            array('subtitle_en, subtitle_ro, subtitle_ru', 'length', 'max'=>164),
			array('title_en, title_ro, title_ru, subtitle_en, subtitle_ro, subtitle_ru, countSlides', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_en, title_ro, title_ru, subtitle_en, subtitle_ro, subtitle_ru', 'safe', 'on'=>'search'),
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
            'subtitle_ru' => Yii::t("BackendModule.backend", 'Подзаголовок на русском'),
            'subtitle_ro' => Yii::t("BackendModule.backend", 'Подзаголовок на молдавском'),
            'subtitle_en' => Yii::t("BackendModule.backend", 'Подзаголовок на английском'),
		);
	}

	/*protected function beforeSave()
    {
        return parent::beforeSave();
    }*/
	protected function beforeValidate()
    {
//        $count = Yii::app()->settings->get(Settings::PAGES, 'slider_numbers', 3);
//        $slides = self::model()->count();

//        if($this->isNewRecord){
//            if($slides >= $count){
//                $this->addError('countSlides', 'Вы не можете создавать более '.$count.' слайдов');
//                return false;
//            }
//        }else{
//            if($slides > $count){
//                $this->addError('countSlides', 'Вы не можете создавать более '.$count.' слайдов');
//                return false;
//            }
//        }

        return parent::beforeValidate();
    }

    public function beforeDelete()
    {
        $count = self::model()->count();
        if($count <= 2){
            Yii::app()->user->setFlash('error', 'Количество слайдов не может быть меньше двух');
            $this->addError('title_en', 'Количество слайдов не может быть меньше двух');
            return false;
        }
        return parent::beforeDelete();
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getContent()
    {
        return $this->{'subtitle_'.Yii::app()->language};
    }

    public function getCompanyPhone()
    {
        $phone = Yii::app()->settings->get(Settings::COMPANY, 'company_numbers', null);
        if(!$phone){
            return '(229) 469-5358';
        }else{
            $return = explode(',', $phone);
            return trim($return[0]);
        }
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slider the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
