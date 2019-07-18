<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 * Расширенное форматирование для внутренних типов
 */

class ExtendedFormatter extends CFormatter
{
    public $dateFormat = 'd/m/Y';
    public $datetimeFormat = 'd/m/Y H:i:s';

    public function formatBoolean($value)
    {

        if ($value > 0)
            return '<i class="material-icons">done</i>';
        else
            return '<i class="material-icons">remove</i>';
    }

    /**
     * Формат пол
     * @param $value
     * @return string
     */
    public function formatSex($value)
    {
        if ($value > 0)
            return 'Female';
        else
            return 'Male';

    }

    /**
     * Формат изображение
     * @param mixed $value
     * @return string
     */
    public function formatImage($value)
    {
        $path_info = pathinfo($value);
        if(!empty($path_info) && isset($path_info['extension']) && $path_info['extension'] == 'swf')
            return 'swf file';

        return CHtml::image(Yii::app()->iwi->load($value)->resize(0, 80, Image::HEIGHT)->cache());
    }

    /**
     * Форматирование пользователя ссылка
     * @param $value
     * @return string
     */
    public function formatUser($value)
    {
        if ($user = User::model()->findByPk($value))
            return CHtml::link($user->fullName, Yii::app()->createUrl("backend/user/view", array("id" => $user->id)));
        else
            return '<span class="null">System</span>';
    }

    /**
     * @todo не доработано нет класса StoreAttribute
     * @param $value
     * @return mixed
     */
    public function formatStoreType($value)
    {
        $ar = StoreAttribute::getTypesList();
        return $ar[$value];
    }

    /**
     * Форматирование типа цена в месяц/год
     * @param $value
     * @return array|mixed|string
     */
    public function formatBidType($value)
    {
        return RealtyOffer::model()->getBidType($value);
    }

    /**
     * Форматирование типа аренда/продажа
     * @param $value
     * @return array|mixed|string
     */
    public function formatRealtyOfferType($value)
    {
        return RealtyOffer::model()->getType($value);
    }

    /**
     * Форматирование иконок FontAwsome
     * @param $value
     * @return string
     */
    public function formatFontAwsome($value)
    {
        return CHtml::tag('i', array('class' => 'fa '.$value));
    }

    public function formatStatus($value) {
        return Realty::model()->getStatus($value);
    }

    /**
     * Форматирование валюты
     * @param $value
     * @return array|mixed|string
     */
    public function formatCurrency($value)
    {
        return RealtyOffer::model()->getCurrency($value);
    }

    /**
     * Формат состояния недвижимости
     * @param $value
     * @return mixed
     */
    public function formatSpaseConditions($value)
    {
        return RealtyDetailedDescription::model()->getSpaseConditions($value);
    }

    /**
     * Форматирование площади м.
     * @param $value
     * @return mixed
     */
    public function formatSpaseSizeUnits($value)
    {
        return RealtyDetailedDescription::model()->getSpaseSizeUnits($value);
    }

    public function formatParcelSizeUnits($value)
    {
        return RealtyDetailedDescription::model()->getParcelSizeUnits($value);
    }

    /**
     * Форматирование типа недвижимости
     * @param $value
     * @return mixed
     */
    public function formatRealtyCategory($value)
    {
        return Realty::model()->getRealtyType($value);
    }

    public function formatMultiRole($value)
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $value);
        $list = Role::model()->findAll($criteria);

        if ($list) {
            $list = CHtml::listData($list, 'id', 'role');
            return implode(', ', $list);
        }

        return '';
    }
}