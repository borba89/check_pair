<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 10/3/12
 * Time: 12:36 PM
 * To change this template use File | Settings | File Templates.
 */

class ActiveRecord extends CActiveRecord
{
    /* Disable flash messages in actions */
    public $flash_messages = true;

    public $resize_avatar = false;

    public function requiredAlert(){
        if (!$this->hasErrors())
            return '<div class="alert alert-close alert-notice">
                        <a class="glyph-icon alert-close-btn icon-remove" title="Close" href="#"></a>
                        <div class="bg-blue alert-icon">
                            <i class="glyph-icon icon-info"></i>
                        </div>
                        <div class="alert-content">
                            <h4 class="alert-title">Success message title</h4>
                            <p>* - поля обязательные к заполнению</p>
                        </div>
                    </div>';
        else
            return '';
    }

    public function getLanguages() {
        $languages = Yii::app()->languages->languages;
        $retArr = array();

        foreach ($languages as $language) {
            $retArr[$language] = $language;
        }

        return $retArr;
    }

    public function getClass() {
        return strtolower(get_class($this));
    }

    protected function beforeSave()
    {
        /**
         * Check for file fields if finded then paste values into form
         */

        $rules = $this->rules();
        foreach ($rules as $rule) {
            if (in_array('file',$rule,true)) {

                $begin = true;
                if(isset($rule['on']))
                {
                    if(is_array($rule['on']))
                    {
                        if(!in_array($this->scenario,$rule['on']))
                            $begin = false;
                    }
                    else
                    {
                        if($this->scenario != $rule['on'])
                            $begin = false;

                        if (!in_array($this->scenario, array_map('trim',explode(",",$rule["on"]))))
                            $begin = false;
                    }
                }

                if($begin)
                {
                    $attributes = array_map('trim',explode(",",$rule[0]));
                    foreach ($attributes as $attribute) {

                        if ($this->hasAttribute($attribute)) {
                            $image = CUploadedFile::getInstance($this, $attribute);
                            if (is_object($image)) {
                                $this->putImages($image, $attribute, $this->resize_avatar);
                            }

                            if (!empty($_POST[get_class($this)][$attribute . "_remove"]))
                                $this->$attribute = "";

                        }
                    }
                }
            }
        }

        if ($this->flash_messages) {
            if(!Yii::app()->controller instanceof Frontend) {
                $name = get_class($this);
                if($this->hasAttribute('name')){
                    $id = CHtml::link($this->name,array('view','id'=>$this->id));
                }else{
                    $id = CHtml::link($this->id,array('view','id'=>$this->id));
                }
                switch ($this->scenario) {
                    case "newcustomer":
                        Yii::log("$name $id was successfully created.", "profile", "backend");
                        Yii::app()->user->setFlash(
                            FlashMessages::SUCCESS_MESSAGE(),
                            Yii::t('BackendModule.backend', ":name was successfully created.", array(':name' => $name))
                        );
                        break;
                    case "insert":
                        Yii::log("$name $id was successfully created.", "profile", "backend");
                        Yii::app()->user->setFlash(
                            FlashMessages::SUCCESS_MESSAGE(),
                            Yii::t('BackendModule.backend', ":name was successfully created.", array(':name' => $name))
                        );
                        break;
                    case "update":
                        Yii::log("$name $id was successfully updated.", "profile", "backend");
                        Yii::app()->user->setFlash(
                            FlashMessages::SUCCESS_MESSAGE(),
                            Yii::t('BackendModule.backend', ":name was successfully updated.", array(':name' => $name))
                        );
                        break;
                    case "updatepassword":
                        Yii::log("Password of user " . $this->name.' '.$this->surname . " was changed successfully.", "profile", "backend");
                        Yii::app()->user->setFlash(
                            FlashMessages::SUCCESS_MESSAGE(),
                            Yii::t('BackendModule.backend', "Password of user :name was changed successfully.", array(':name' => $this->name.' '.$this->surname))
                        );
                        break;
                    case "updatepasswordBackend":
                        Yii::log("Password of user " . $this->name.' '.$this->surname . " was changed successfully.", "profile", "backend");
                        Yii::app()->user->setFlash(
                            FlashMessages::SUCCESS_MESSAGE(),
                            Yii::t('BackendModule.backend', "Password of user :name was changed successfully.", array(':name' => $this->name.' '.$this->surname))
                        );
                        break;
                    default:
                        break;
                }
            }
        }

        /**
         * Check if author exists in model then paste value info form
         */

        if ($this->hasAttribute('author') && empty($this->author))
            $this->author = Yii::app()->user->id;

        return parent::beforeSave();
    }


    /**
     * @var $image CUploadedFile
     */
    protected function putImages($image, $attribute, $resize = false)
    {
        $filename = $this->imageName($image);
        $path = 'images/site/' . get_class($this) . "/" . $filename;
        $dir = Yii::getPathOfAlias("webroot") . '/images/site/' . get_class($this) . '/';

        $path = strtolower($path);
        $dir = strtolower($dir);

        if (!is_dir($dir))
            mkdir($dir, 0777, true);

        $this->$attribute = $path;
        $image->saveAs($path);

        if($resize){
            $img = Yii::app()->image->load($path);
            $img->smart_resize(128, 128);
            $img->save();
        }
    }

    public function imageName($name)
    {
        $data = explode(".",$name);
        $ext = ".".$data[count($data)-1];
        $filename = md5(rand(1, 99999) . $name) . $ext;
        return $filename;
    }



    protected function afterDelete()
    {
        $name = get_class($this);
        if($this->hasAttribute('name')){
            $id = CHtml::link($this->name,array('view','id'=>$this->id));
        }else{
            $id = CHtml::link($this->id,array('view','id'=>$this->id));
        }
        Yii::log("$name $id was successfully deleted.", "profile", "backend");
        Yii::app()->user->setFlash('success', "$name was successfully deleted.");
    }

    public function dinamicImage($model, $attribute)
    {
        $attributeClean = preg_replace('~^\[[0-9]+\]~', '', $attribute);

        $image=CUploadedFile::getInstance($model, $attribute);
        $filename = $this->imageName($image);

        $path = 'images/site/' . get_class($this) . "/" . $filename;
        $dir = Yii::getPathOfAlias("webroot") . '/images/site/' . get_class($this) . '/';

        $path = strtolower($path);
        $dir = strtolower($dir);

        if (!is_dir($dir))
            mkdir($dir, 0777, true);

        $this->$attributeClean = $path;
        $image->saveAs($path);
    }
}
