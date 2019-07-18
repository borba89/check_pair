<?php
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $identity
 * @property string $network
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property integer $is_active
 * @property string $last_login
 * @property string $date_joined
 * @property string $photo
 * @property string $role
 *
 *
 */
class User extends ActiveRecord
{
    public $flash_messages = false;

    public $resize_avatar = true;

    const ADMIN = 'admin';
    const BROCKER = 'broker';
    const CONTENT_MANAGER = 'content_manager';

    const ACTIVE = 1;
    const INACTIVE = 0;

    public $searchString;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public $password_repeat;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, surname, email, password, password_repeat, role', 'required', 'on' => 'insert'),
            array('name, surname, email, role', 'required', 'on' => 'update'),
            array('password, password_repeat', 'required', 'on' => 'updatepassword'),
            array('email', 'noEmail', 'on' => 'changepassward'),
            array('is_active', 'numerical', 'integerOnly' => true),
            array('photo', 'file', 'types'=>'png, jpg, gif, swf', 'safe' => false, 'allowEmpty'=>true),
            array('password', 'length', 'min' => 5),
            array('name, surname', 'length', 'max' => 255),
            array('password', 'length', 'max' => 50),
            array('salt', 'length', 'max' => 32),
            array('email', 'unique'),
            array('email', 'email', 'message' => 'Email is not valid.'),
            array('password', 'compare', 'on' => 'insert, updatepassword'),
            array('password_repeat, last_login, date_joined, role', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('language', 'default', 'value'=>'ru'),
            array('id, name, surname, email, is_active, last_login, date_joined, role, searchString', 'safe', 'on' => 'search'),
            array('date_joined', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => false, 'on' => 'insert'),
        );
    }

    public function scopes()
    {
        return array(
            'is_active'=>array('condition'=>"is_active = '1'"),
        );
    }

    public function noEmail()
    {
        $error = true;
        $model = self::model()->find(array(
                'condition'=>'email = :id',
                'params'=>array('id'=>$this->email),
            )
        );

        if(isset($model) && empty($model->identity)) {
            $error = false;
        }

        if ($error == true) {
            $this->addError('video', 'Такого емэйла нет в базе данных.');
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
            'phones'=>array(self::HAS_MANY, 'PhonesBroker', 'broker_id')
        );
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    public function generateSalt()
    {
        return uniqid('', true);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'identity' => 'Identity',
            'network' => 'Network',
            'name' => Yii::t("base","Имя"),
            'surname' => Yii::t("base","Фамилия"),
            'email' => yII::T("base","Емэйл"),
            'password' => Yii::t("base","Пароль"),
            'password_repeat' => Yii::t("base","Повторить пароль"),
            'salt' => yII::T("base","Соль"),
            'fullName' => yII::T("base","Полное имя"),
            'is_active' => yII::T("base","Активный"),
            'last_login' => yII::T("base","Последний визит"),
            'date_joined' => yII::T("base","Дата регистрации"),
            'photo' => yII::T("base","Аватар"),
            'role' => yII::T("base","Роль"),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */

    public function getIsUserOnline()
    {
        // select five minutes ago
        $five_minutes_ago = mktime(date("H"), date("i") - 5, date("s"), date("m"), date("d"), date("Y"));

        if ($this->last_login > $five_minutes_ago)
            return true;
        else
            return false;
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        if ($this->searchString) {
            $queryTerms = explode(' ', $this->searchString);

            $crt = new CDbCriteria;
            $crt->select = 't.id as id';

            foreach ($queryTerms as $k => $req) {
                $tCriteria = new CDbCriteria();
                $tCriteria->condition = "t.name LIKE :$k OR t.surname LIKE :$k";
                $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';
                $crt->mergeWith($tCriteria);
            }

            $info = $this->findAll($crt);
            $in = CHtml::listData($info, 'id', 'id');

            $criteria->addInCondition('id', $in);
        }

        $criteria->compare('name',$this->name, true);
        $criteria->compare('surname',$this->surname, true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('role',$this->role);
        $criteria->compare('is_active',$this->is_active);
        $criteria->compare('last_login',$this->last_login,true);
        $criteria->compare('date_joined',$this->date_joined,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'last_login' => array(
                        'asc'=>'last_login ASC',
                        'desc'=>'last_login DESC',
                        'default'=>'desc',
                    )
                ),
            ),
        ));
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->salt = $this->generateSalt();
            $this->password = $this->hashPassword($this->password, $this->salt);
        }

        //Если загружено новое фото, удалить старое
        if($this->photo && $_FILES['User']['name']['photo']){
            $path = Yii::getPathOfAlias('webroot').'/'.$this->photo;
            @unlink($path);
        }

        return parent::beforeSave();
    }

    public function afterSave()
    {
        //\protected\components\ActiveRecord.php строка 76, делается запись картинки

        if(isset($_POST['PhonesBroker'])){
            PhonesBroker::model()->deleteAll('broker_id=:broker', array(':broker'=>$this->id));
            foreach ($_POST['PhonesBroker']['phone'] as $item) {
                if(!$item){
                    continue;
                }
                $phone = new PhonesBroker();
                $phone->broker_id = $this->id;
                $phone->phone = $item;
                $phone->save();
            }
        }elseif (!isset($_POST['PhonesBroker']) && $this->role == self::BROCKER && $this->scenario == 'update'){
            PhonesBroker::model()->deleteAll('broker_id=:broker', array(':broker'=>$this->id));
        }

        parent::afterSave();
    }

    public function todayRegistrations()
    {
        $crt = new CDbCriteria();
        $day_ago = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
        $crt->select = '*, UNIX_TIMESTAMP(date_joined) as date_joined';
        $crt->condition = 'date_joined > :param';
        $crt->params = array(':param' => $day_ago);
        return self::model()->findAll($crt);
    }

    public function getFullName() {
        return $this->name.' '.$this->surname;
    }

    public function getFrontFullName() {
        return $this->name.' '.CStringHelper::truncate($this->surname, 1, '.');
    }

    public function getAllRoles($value = null)
    {
        $roles = array(
            self::ADMIN => 'Администратор',
            self::BROCKER => 'Агент недвижимости',
            self::CONTENT_MANAGER => 'Контент менеджер',
        );

        if ($value) {
            return $roles[$value];
        }

        return $roles;
    }

    public function suggestTag($keyword){
        $keyword = htmlspecialchars($keyword);
        $keyword = mb_strtolower($keyword, 'UTF-8');

        $users = User::model()->findAll($this->searchCriteria($keyword));
        return $users;
    }

    public function searchCriteria($q) {
        $queryTerms = explode(' ', $q);

        $crt = new CDbCriteria;
        foreach ($queryTerms as $k => $req) {
            $tCriteria = new CDbCriteria();

            $tCriteria->condition = "name LIKE :$k OR surname LIKE :$k OR role LIKE :$k";
            $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';

            $crt->mergeWith($tCriteria);
        }
        $crt->order = 't.id DESC';
        return $crt;
    }

    /**
     * Return users array by role
     * @param $role string (admin, broker, etc...)
     * @return array (id, fullName)
     */
    public function getUsersByRole($role)
    {
        $out = array();
        $users = self::model()->findAllByAttributes(array(
            'role'=>$role
        ));
        $out[''] = 'Назначьте агента';
        foreach ($users as $user) {
            $out[$user->id] = $user->fullName;
        }
        return $out;
    }

    /**
     * Аватарка сотрудника, если нет, вернуть значение по умолчанию
     * @return string
     */
    public function getAvatarSrc()
    {
        return ($this->photo)? $this->photo:'images/profile-no-photo.png';
    }

    /**
     * Вернуть список телефонов, разделенных запятыми.
     * @return string
     */
    public function viewPhones()
    {
        $out = array();
        foreach ($this->phones as $phone) {
            $out[] = $phone->phone;
        }
        return implode(', ', $out);
    }

    public function viewPhone()
    {
        $out = array();
        foreach ($this->phones as $phone) {
            $out[] = $phone->phone;
        }
        return isset($out[0])?$out[0]:'';
    }

    public static function allowedBackendRoles()
    {
        return array(
            self::BROCKER,
            self::CONTENT_MANAGER,
            self::ADMIN
        );
    }
}
