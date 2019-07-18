<?php

/**
 * This is the model class for table "content_block".
 *
 * The followings are the available columns in table 'content_block':
 * @property integer $id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property string $code
 * @property integer $type
 * @property string $title_en
 * @property string $title_ro
 * @property string $title_ru
 * @property string $content_en
 * @property string $content_ro
 * @property string $content_ru
 */
class ContentBlock extends ActiveRecord
{
    const SIMPLE_TEXT = 1;
    const PHP_CODE    = 2;
    const HTML_TEXT   = 3;

    const REALTY    = 'realty_types';
    const PARTNERS  = 'partners';
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'content_block';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('category, name, code', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('category, description', 'length', 'max'=>255),
			array('name', 'length', 'max'=>250),
			array('code', 'length', 'max'=>100),
			array('title_en, title_ro, title_ru, content_en, content_ro, content_ru', 'safe'),
            array('image', 'file', 'types'=>'png, jpg, gif, swf', 'safe' => false, 'allowEmpty'=>true),
			array('id, category, name, description, code, type, title_en, title_ro, title_ru, content_en, content_ro, content_ru', 'safe', 'on'=>'search'),
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

	public function beforeSave()
    {
//            if($this->category == self::PARTNERS){
//                $count = self::model()->countByAttributes(array('category'=>self::PARTNERS));
//                if (!$this->isNewRecord) {
//                    if ($already_exist = self::model()->findByAttributes(['id' => $this->id, 'category'=>self::PARTNERS])) {
//                        $count--;
//                    }
//                }
//                $limit = Yii::app()->settings->get(Settings::PAGES, 'count_partners', Settings::COUNT_PARTNERS);
//                if($count >= $limit){
//                    $this->addError('category', Yii::t('BackendModule', 'Вы исчерпали лимит элементов для этого блока'));
//                    return false;
//                }
//            }
        return parent::beforeSave();
    }
	public function afterSave()
    {
        parent::afterSave();
        //\protected\components\ActiveRecord.php строка 76, делается запись картинки
        // Теперь мы изменяем ее разрешение
        if($this->image){
            $image = Yii::app()->iwi->load($this->image);
            //Сохраним в хорошем разрешении, при редактировании будет ресайз из файла хорошего разрешения
            $data = explode("/",$this->image);
            $filename = $data[count($data)-1];

            $path = 'images/site/' . get_class($this) . "/2500x2500_" . $filename;
            $path = strtolower($path);
            $full_path = Yii::getPathOfAlias("webroot") . '/' . $path;

            if (!file_exists($full_path)){
            $image->adaptive_new(2500, 2500, false, false);
            $image->save($path);
            } else {
                $image = Yii::app()->iwi->load($path);
            }
            //Сохраним в нужном разрешении
            $image->resize(1200, 1200);
            $image->save($this->image);
        }
    }

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => Yii::t('BackendModule.backend','Category'),
			'name' => Yii::t('BackendModule.backend','Название'),
			'description' => Yii::t('BackendModule.backend','Description'),
			'code' => Yii::t('BackendModule.backend','Code'),
			'type' => Yii::t('BackendModule.backend','Тип содержания'),
            'title_ru' => Yii::t("OfferModule.offer", 'Заголовок на русском'),
            'title_ro' => Yii::t("OfferModule.offer", 'Заголовок на молдавском'),
            'title_en' => Yii::t("OfferModule.offer", 'Заголовок на английском'),
            'content_ru' => Yii::t("BackendModule.backend", 'Содержание на русском'),
            'content_ro' => Yii::t("BackendModule.backend", 'Содержание на молдавском'),
            'content_en' => Yii::t("BackendModule.backend", 'Содержание на английском'),
            'image' => Yii::t("BackendModule.backend", 'Изображение'),
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('content_en',$this->content_en,true);
		$criteria->compare('content_ro',$this->content_ro,true);
		$criteria->compare('content_ru',$this->content_ru,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTypes()
    {
        return array(
            self::SIMPLE_TEXT => Yii::t('BackendModule.backend','Обычный текст'),
            self::PHP_CODE    => Yii::t('BackendModule.backend','Исполняемый PHP код'),
            self::HTML_TEXT   => Yii::t('BackendModule.backend','HTML код'),
        );
    }

	public function getCategories()
    {
        return array(
            self::REALTY    =>Yii::t('backend', 'Типы недвижимости на главной'),
            self::PARTNERS  =>Yii::t('backend', 'Наши партнеры на главной'),
        );
    }

    public function getCategoryName()
    {
        $categories = $this->getCategories();
        return $categories[$this->category];
    }

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getContent()
    {
        return $this->{'content_'.Yii::app()->language};
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContentBlock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
