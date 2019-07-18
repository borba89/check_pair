<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 05.02.19
 * Time: 20:18
 */

class Recently extends CApplicationComponent
{
    public function setProperty($id)
    {
        $properties = Yii::app()->request->cookies->contains('recently_properties') ? Yii::app()->request->cookies['recently_properties']->value : null;

        if($properties){
            $properties = CJSON::decode($properties);
        }

//        if(!$properties){
//            $arr = array();
//            array_push($arr, $id);
//            $cookie = new CHttpCookie('recently_properties', CJSON::encode($arr));
//            $cookie->expire = time()+60*60*24*30;//на 180 дней запомнить
//            Yii::app()->request->cookies['recently_properties'] = $cookie;
//        }elseif (count($properties) < 9){
//            //Если такое значение уже существует в массиве, не добавлять его в массив
//            if(!in_array($id, $properties)){
//                //Добавить id вмассив
//                array_push($properties, $id);
//                $cookie = new CHttpCookie('recently_properties', CJSON::encode($properties));
//                $cookie->expire = time()+60*60*24*30;//на 180 дней запомнить
//                Yii::app()->request->cookies['recently_properties'] = $cookie;
//            }
//        }else{
//            if(!in_array($id, $properties)){
//                //удалить первый элемент и добавить новый в массив
//                $reduceProperties = array_shift($properties);
//                if(is_string($reduceProperties)){
//                    $reduceProperties = array($reduceProperties);
//                }
//                array_push($reduceProperties, $id);
//                $cookie = new CHttpCookie('recently_properties', CJSON::encode($reduceProperties));
//                $cookie->expire = time()+60*60*24*180;//на 180 дней запомнить
//                Yii::app()->request->cookies['recently_properties'] = $cookie;
//            }
//        }
//без ограничений вставляется последним
        if(!$properties){
            $arr = array();
            array_push($arr,$id);
            $cookie = new CHttpCookie('recently_properties', CJSON::encode($arr));
            $cookie->expire = time()+60*60*24*30;//на 180 дней запомнить
            Yii::app()->request->cookies['recently_properties'] = $cookie;
        }else {
            //Если такое значение уже существует в массиве, не добавлять его в массив
            if(!in_array($id, $properties)){
                //Добавить id вмассив
                array_push($properties,$id);
                $cookie = new CHttpCookie('recently_properties', CJSON::encode($properties));
                $cookie->expire = time()+60*60*24*30;//на 180 дней запомнить
                Yii::app()->request->cookies['recently_properties'] = $cookie;
            } else {
                // Если есть удалить и вставить первым
                if (($key = array_search($id,$properties)) !== FALSE){
                unset($properties[$key]);
                    array_push($properties,$id);
                    $cookie = new CHttpCookie('recently_properties', CJSON::encode($properties));
                    $cookie->expire = time()+60*60*24*30;//на 180 дней запомнить
                    Yii::app()->request->cookies['recently_properties'] = $cookie;
                }

            }
        }

    }

    public function getProperty()
    {
        $properties = Yii::app()->request->cookies->contains('recently_properties') ? Yii::app()->request->cookies['recently_properties']->value : null;
        return CJSON::decode($properties);
    }
}