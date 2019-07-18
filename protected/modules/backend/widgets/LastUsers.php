<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

class LastUsers extends CWidget
{
    public function run()
    {

        $crt = new CDbCriteria();
        $day_ago = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
        $crt->select = '*, UNIX_TIMESTAMP(last_login) as last_login';
        $crt->condition = 'last_login > :param AND is_staff = 1';
        $crt->params = array(':param' => $day_ago);

        $users = User::model()->findAll($crt);
        $this->render('last_users',array('users'=>$users));
    }
}