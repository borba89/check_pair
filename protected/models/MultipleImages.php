<?php

/**
 * This is the model class for table "album_image".
 *
 * The followings are the available columns in table 'album_image':
 * @property integer $id
 * @property integer $item_id
 * @property string $title_ro
 * @property string $title_ru
 * @property string $path
 * @property string $created
 * @property string $content_type
 * @property integer $is_main
 */
class MultipleImages extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'multiple_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('author', 'length', 'max'=>80),
			array('title, path, item_id', 'length', 'max'=>255),
            array('clone, is_main', 'safe'),
            array('clone, priority', 'default', 'value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_id, title_ro, title_ru, path, author', 'safe', 'on'=>'search'),
            array('author', 'default', 'value' => Yii::app()->user->id, 'setOnEmpty' => false, 'on' => 'insert'),
            array('created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'),
		);
	}

    public function behaviors(){
        return array(
            'imageBehavior' => array(
                'class' => 'backend.components.behavior.TagsBehavior',
            ),
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
            'tags'=>array(self::MANY_MANY, 'Tags', 'contype_tags(item_id, tag_id)', 'condition' => 'content_type = :type', 'params' => array(':type' => $this->getClass())),
		);
	}

	public function beforeSave()
    {
        $this->created = date('Y-m-d H:i:s');
        return parent::beforeSave();
    }

    public function afterSave()
    {
        $this->imposeWatermark();
        parent::afterSave();
    }

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_id' => 'Content type',
			'title_ro' => 'Title Ro',
			'title_ru' => 'Title Ru',
			'path' => 'Path',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('path',$this->path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Наложить водяной знак при сохранении
     * @return mixed
     */
	private function imposeWatermark()
    {
        $watermark = Yii::getPathOfAlias('webroot').Yii::app()->settings->get(Settings::COMPANY, 'company_watermark');

        if(!is_file($watermark)){
            return Yii::app()->ih
                ->load(Yii::getPathOfAlias('webroot') .'/'. $this->path)
                ->save(Yii::getPathOfAlias('webroot') .'/'. $this->path);
        }else{
            return Yii::app()->ih
                ->load(Yii::getPathOfAlias('webroot') .'/'. $this->path)
                ->watermark($watermark, 10, 20, CImageHandler::CORNER_CENTER, 0.4)
                ->save(Yii::getPathOfAlias('webroot') .'/'. $this->path);
        }

    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlbumImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }
}
