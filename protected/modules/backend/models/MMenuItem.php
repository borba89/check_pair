<?php

/**
 * This is the model base class for the table "menu_item".
 *
 * Columns in table "menu_item" available as properties of the model:
 * @property integer $id
 * @property integer $menu_id
 * @property integer $parent_id
 * @property string $name_en
 * @property string $name_ru
 * @property string $name_ro
 * @property integer $enabled
 * @property string $target
 * @property string $description
 * @property string $link_en
 * @property string $link_ru
 * @property string $link_ro
 * @property string $type
 * @property string $role
 *
 * Relations of table "menu_item" available as properties of the model:
 * @property MMenu $menu
 * @property MMenuItem $parent
 * @property MMenuItem $children
 */
class MMenuItem extends ActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        return parent::init();
    }

    public function tableName() {
        return 'menu_item';
    }

    public function rules() {
        return array(
            array('name_en, name_ru, name_ro', 'required'),
            array('menu_id, parent_id, enabled, target, link_en, link_ru, link_ro, type, role', 'default', 'setOnEmpty' => true, 'value' => null),
            array('menu_id, enabled', 'numerical', 'integerOnly' => true),
            array('name_en, name_ru, name_ro', 'length', 'max' => 128),
            array('target', 'length', 'max' => 10),
            array('type', 'length', 'max' => 50),
            array('description, link_en, link_ru, link_ro, role', 'safe'),
            array('id, menu_id, parent_id, depth, lft, rgt, name_en, name_ru, name_ro, enabled, target, description, link_en, link_ru, link_ro, type, role', 'safe', 'on' => 'search'),
        );
    }

    public function __toString() {
        return (string) $this->name;
    }

    public function behaviors() {
        return array(
            'activerecord-relation' => array('class' => 'application.components.EActiveRecordRelationBehavior')
        );
    }

    public function relations() {
        return array(
            'menu' => array(self::BELONGS_TO, 'MMenu', 'menu_id'),
            'parent' => array(self::BELONGS_TO, 'MMenuItem', 'parent_id'),
            'children' => array(self::HAS_MANY, 'MMenuItem', 'parent_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'menu_id' => Yii::t('app', 'Меню'),
            'parent_id' => Yii::t('app', 'Родительский пункт меню'),
            'name' => Yii::t('app', 'Заголовок'),
            'enabled' => Yii::t('app', 'Опубликовано'),
            'target' => Yii::t('app', 'Target'),
            'description' => Yii::t('app', 'Описание'),
            'link' => Yii::t('app', 'Link/Path'),
            'role' => Yii::t('app', 'Отображать для:'),
            'type' => Yii::t('app', 'Тип'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('menu_id', $this->menu_id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('enabled', $this->enabled);
        $criteria->compare('target', $this->target);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('role', $this->role, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

    public function getMaxRight()
    {
        return Yii::app()->db->createCommand()
                        ->select('MAX(`rgt`)')
                        ->from($this->tableName())
                        ->queryScalar();
    }

    public function getRoles()
    {
        $roles = array(
            'all' => 'Всех',
            'guest' => 'Гостей',
            'loggedIn' => 'Авторизованных пользователей',
        );
        if (Yii::app()->hasModule('role')) {
            return array_merge($roles, CHtml::listData(Role::model()->findAll(), 'name', 'name'));
        }
        return $roles;
    }

    public function getName()
    {
        return $this->{'name_'.Yii::app()->language};
    }

    public function getLink()
    {
        return $this->{'link_'.Yii::app()->language};
    }

}
