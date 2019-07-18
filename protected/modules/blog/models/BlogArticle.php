<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property integer $category_id
 * @property string $language
 * @property string $author
 * @property string $title
 * @property string $subtitle
 * @property string $content
 * @property string $image
 * @property integer $views
 * @property string $created
 * @property string $updated
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property ArticleCategory $category
 */
class BlogArticle extends ActiveRecord
{
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $_url;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, title, subtitle, author', 'required', 'on' => 'step0'),
            array('content', 'required', 'on' => 'step1'),
			array('is_active, category_id', 'numerical', 'integerOnly'=>true),
			array('title, image, author', 'length', 'max'=>255),
            array('image', 'file', 'types'=>'jpg, gif, png, jpeg', 'allowEmpty'=>true, 'safe' => false),
            array('language', 'in', 'range'=>array('en','ro','ru'), 'allowEmpty'=>false),
            array('subtitle, content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, author, title, subtitle, created, is_active', 'safe', 'on'=>'search'),
            array('updated', 'default', 'value' => date('Y-m-d H:i:s'),'setOnEmpty' => false, 'on' => 'update'),
            array('created, updated', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => false, 'on' => 'insert'),
		);
	}

    public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'is_active = 1',
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
            'author' => array(self::BELONGS_TO, 'User', 'author'),
            'category' => array(self::BELONGS_TO, 'ArticleCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'category_id' => Yii::t("BlogModule.blog", 'Category'),
			'title' => Yii::t("BlogModule.blog", 'Заголовок'),
			'subtitle' => Yii::t("BlogModule.blog", 'Подзаголовок'),
			'content' => Yii::t("BlogModule.blog", 'Контент'),
			'image' => Yii::t("BlogModule.blog", 'Фотография'),
			'created' => Yii::t("BlogModule.blog", 'Время создания'),
			'updated' => Yii::t("BlogModule.blog", 'Время редактирования'),
			'author' => Yii::t("BlogModule.blog", 'Автор'),
			'is_active' => Yii::t("BlogModule.blog", 'Активность статьи'),
            'views' => Yii::t("OfferModule.offer", 'Количество просмотров'),
            'language' => Yii::t("OfferModule.offer", 'Язык'),
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
	public function search($criteria = null)
	{
		if (!$criteria) {
            $criteria=new CDbCriteria;
        }

        if (!isset($this->is_active)) {
            $this->is_active = self::ACTIVE;
        }

		$criteria->compare('language',$this->language);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('subtitle',$this->subtitle,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function frontSearch($query)
    {
        $criteria = new CDbCriteria;
        $criteria->addSearchCondition('title', $query);
        $criteria->addSearchCondition('content', $query, true, 'OR');

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogArticle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getUrl()
    {
        return $this->_url = Yii::app()->createUrl('/blog/frontBlog/view', array('id' => $this->id));
    }

    public function getAllUsers()
    {
        $users = User::model()->is_active()->findAll();
        return CHtml::listData($users,'id','fullName');
    }

    public function getCountComments()
    {
        Yii::import('comments.models.Comment');
        $criteria = new CDbCriteria();
        $criteria->compare('owner_id', $this->id);
        $criteria->compare('status', '<>'.Comment::STATUS_DELETED);
        $comments = Comment::model()->findAll($criteria);
        if ($comments){
            foreach ($comments as $key => $value) {
                if ($parent = $value->parent) {
                    if ($parent->status == Comment::STATUS_DELETED) {
                        unset($comments[$key]);
                    }
                }
            }
        }
//        $comments = (Comment::model()->count($criteria));
        $comments = count($comments);
        return $comments.' '.YHelper::plural($comments, Yii::t('MainModule.main','комментарий'), Yii::t('MainModule.main','комментария'), Yii::t('MainModule.main','комментариев'));
    }
	
}
