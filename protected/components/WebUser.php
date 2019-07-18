<?php
Yii::import('backend.models.User');

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $_model;

    // Return first name.
    // access it by Yii::app()->user->first_name
    public function getFullName(){
        $user = $this->loadUser;
        return $user->name.' '.$user->surname;
    }

    public function getEmail(){
        $user = $this->loadUser;
        return $user->email;
    }

    public function getIsAdmin(){
        $user = $this->loadUser;

        if($user && $user->role == User::ADMIN)
            return true;

        return false;
    }

    /**
     * Access to backend
     * @return bool
     */
    public function getIsBackend(){
        $user = $this->loadUser;

        if(!$user){
            return false;
        }

        if($user->role == User::ADMIN || $user->role == User::BROCKER || $user->role == User::CONTENT_MANAGER){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getIsBroker()
    {
        $user = $this->loadUser;

        if($user && $user->role == User::BROCKER){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getIsContentManager()
    {
        $user = $this->loadUser;

        if($user && $user->role == User::CONTENT_MANAGER){
            return true;
        }
        return false;
    }

    public function getRole()
    {
        $user = $this->loadUser;
        return ($user)?$user->role:'guest';
    }

    /**
     * @param string $operation
     * @param array $params
     * @param bool $allowCaching
     * @return bool|mixed
     */
    public function checkAccess($operation, $params=array(), $allowCaching=true)
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getRole();
        if ($role === User::ADMIN) {
            return true; // admin role has access to everything
        }
        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }

    public function getAvatar(){
        $user = $this->loadUser;
        return YHelper::getImagePath($user->photo);
    }

    public function getProfileField($field)
    {
        if (Yii::app()->getUser()->hasState($field)) {
            return Yii::app()->user->getState($field);
        }

        $profile = $this->loadUser;

        if (null === $profile) {
            return null;
        }

        $value = $profile->$field;

        Yii::app()->getUser()->setState($field, $value);

        return $value;
    }

    // Load user model.
    public function getloadUser()
    {
        if ($this->_model===null) {
            $this->_model=User::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}