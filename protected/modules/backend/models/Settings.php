<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $category
 * @property string $key
 * @property string $value
 */
class Settings extends ActiveRecord
{
    public $flash_messages = false;

    const GENERAL = 'general';
    const MAIL = 'mail';
    const COMPANY = 'company';
    const PAGES = 'pages';
    const CUSTOM = 'custom';

    const TEXTFIELD = 'textField';
    const TEXTAREA = 'textArea';
    const IMAGE = 'image';
    const WYSIWYG = 'wysiwyg';
    const CHECKFIELD = 'checkField';

    const COUNT_PARTNERS = 6;

    public $data;
    public $cur_id;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
            array('category, key, value', 'required'),
            array('category, key', 'length', 'max'=>255),
            array('value', 'safe'),
            //array('value', 'safe', 'except' => 'image'),
            //array('value', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'safe' => false, 'on' => 'image'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, category, key, value', 'safe', 'on'=>'search'),
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
			'category' => Yii::t('app', 'Category'),
			'value' => Yii::t('app', 'Value'),
            'key' => Yii::t('app', 'Key'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($param)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

        $criteria->compare('category', $this->category);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('value',$this->value,true);

        /*if($param == self::GENERAL){
            $criteria->compare('category', $param);
        }*/

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTypes()
    {
        return array(
            'textField' => 'Text Field',
            'textArea' => 'Text Area',
            'image' => 'Image',
            'wysiwyg' => 'WYSIWYG',
            'checkField' => 'Check Field'
        );
    }

    public function getSameGroup()
    {
        $ret = null;
        if(!empty($this->group)) {
            $criteria = new CDbCriteria();
            $criteria->condition = "`group` = :group";
            $criteria->params[':group'] = $this->group;
            $ret = Settings::model()->findAll($criteria);
        }
        return $ret;
    }

    public function getCategories()
    {
        return array(
            self::GENERAL => 'General',
            self::PAGES => 'Страницы сайта',
            self::COMPANY => 'Контактные данные организации',
            self::MAIL => 'Шаблоны писем',
            self::CUSTOM => 'Custom',
        );
    }
}