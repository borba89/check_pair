<?php
Yii::import('backend.models.Settings');

class YHelper
{
    public static function yiisetting($name, $default = null)
    {
        if ($setting = Settings::model()->findByAttributes(array("name"=>$name)))
            if (isset($setting))
                return $setting->value;

        return $default;
    }

    public static function generateStr($length = 16)
    {
        $chars = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789");
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }

    public static function formatCurrency($value, $currency = "MDL", $format = '#,##0.00 ¤')
    {
        return Yii::app()->numberFormatter->format($format, $value, $currency);
    }

    public static function formatDate($formatGet, $date = null, $formatSet = 'yyyy-MM-dd')
    {
        if($date)
            $newDate =  Yii::app()->dateFormatter->format($formatGet, CDateTimeParser::parse($date, $formatSet));
        else
            $newDate = Yii::app()->format->date($formatGet);

        return $newDate;
    }

    public static function curnav($expect, $class = 'active')
    {
        return Yii::app()->controller->_curNav == $expect ? $class : '';
    }

    public static function getImagePath($source_image, $width = 0, $height = 0, $default = '') {
        if (preg_match('~^(http|https)://~', $source_image))
            return $source_image;

        if (!empty($source_image) && file_exists($source_image)) {
            $image_info = getimagesize($source_image);
            if (!is_array($image_info) OR count($image_info) < 3)
                $source_image = $default ? : Yii::app()->params['noImage'];
        } else{
            $source_image = $default ? : Yii::app()->params['noImage'];
        }

        if (empty($width) && empty($height)){
            $image = '/' . $source_image;
        } elseif (!empty($width) && empty($height)){
            $image = Yii::app()->iwi->load($source_image)->resize($width, 0)->cache();
        } elseif (!empty($height) && empty($width)){
            $image = Yii::app()->iwi->load($source_image)->resize(0, $height, Image::HEIGHT)->cache();
        } else{
            $image = Yii::app()->iwi->load($source_image)->adaptive($width, $height, true)->cache();
        }

        //Накладываем водяной знак
        //self::setWatermark($image);

        return $image;
    }

    public static function get_client_ip() {
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = false;

        return $ipaddress;
    }

    /**
     * Множественные числа
     * @param $n количество
     * @param $one комментарий
     * @param $two комментария
     * @param $many комментариев
     * @return mixed
     */
    public static function plural($n,$one,$two,$many)
    {
        return $n%10==1&&$n%100!=11?$one:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$two:$many);
    }

    /**
     * вернуть первый номер телефона
     * @param $str
     * @return mixed
     */
    public static function firstNumber($str)
    {
        $arr = explode(',', $str);
        return $arr[0];
    }

    /**
     * Сколько осталось дней
     * @param $futureDate (2019-09-13)
     * @param $currentDate (2019-03-19)
     * @return float
     */
    public static function remainingDays($futureDate, $currentDate)
    {
        $future = strtotime($futureDate); //Future date.
        $timefromdb = strtotime($currentDate);//source time
        $timeleft = $future-$timefromdb;
        $daysleft = round((($timeleft/24)/60)/60);
        $daysleft = ($daysleft <= 0)?0:$daysleft;
        return $daysleft;
    }

    private static function setWatermark($image)
    {
        //получить файл водяного знака
        $watermark = Yii::getPathOfAlias('webroot').Yii::app()->settings->get(Settings::COMPANY, 'company_watermark');

        if(!is_file($watermark)){
            Yii::app()->ih
                ->load(Yii::getPathOfAlias('webroot') .'/'. $image)
                ->save(Yii::getPathOfAlias('webroot') .'/'. $image);
        }else{
            Yii::app()->ih
                ->load(Yii::getPathOfAlias('webroot') .'/'. $image)
                ->watermark($watermark, 10, 20, CImageHandler::CORNER_CENTER, 0.3)
                ->save(Yii::getPathOfAlias('webroot') .'/'. $image);
        }
    }
}
