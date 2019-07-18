<?php
class ApiOperationFunctions
{
    public function getBetweenFilter($in)
    {
        $start = 0;
        $end = 0;
        $disableFilter = array();
        foreach ($in as $key => $filter) {
            if (strpos($filter, '<') === 0) {
                $end = substr($filter, 1);
            }
            if (strpos($filter, '>') === 0) {
                $disableFilter = array_slice($in, 0, $key);
                $start = substr($filter, 1);
            }
            if (strpos($filter, '-') != false) {
                $range = explode('-', $filter);
                if ($start != 0 && $range[0] < $start) {
                    $start = $range[0];
                } elseif ($start != 0 && $range[0] > $start && $end != $range[0]) {
                    $disableFilter = array_slice($in, 0, $key);
                    $start = $range[0];
                } elseif ($start == 0 && $end != $range[0]) {
                    $disableFilter = array_slice($in, 0, $key);
                    $start = $range[0];
                }
                if ($end < $range[1]) {
                    $end = $range[1];
                }
            }
        }

        if ($start == $end || $start > $end) {
            $end = 0;
        }

        return array('start' => $start, 'end' => $end, 'disableFilter' => $disableFilter);
    }


    public function getBetweenRooms($in)
    {
        $start = 0;
        $end = 0;
        $disableFilter = array();
        $count = count($in);
        $countFrom0 = $count - 1;

        foreach ($in as $key => $filter) {
            if (strpos($filter, '<') === 0) {
                $end = substr($filter, 1);
            } elseif (strpos($filter, '>') === 0) {
                $disableFilter = array_slice($in, 0, $key);
                $start = substr($filter, 1);
                $end = 0;
            } else {
                if ($end < $filter && $count == 1) {
                    $end = $filter;
                } elseif ($end < $filter && $count > 1) {
                    if ($start == 0) {
                        $start = $end;
                    }
                    $end = $filter;
                }
            }

            if ($key == $countFrom0 && ($end - $start > $countFrom0)) {
                $start = 0;
                $disableFilter = array_slice($in, 0, $key);
            }
        }

        return array('start' => $start, 'end' => $end, 'disableFilter' => $disableFilter);
    }

    public function formatFilter($activeFilter, $area = false, $units = false)
    {
        $activeFilter['start'] = $this->filterUnits($activeFilter['start'], $area, false, $units);
        $activeFilter['end'] = $this->filterUnits($activeFilter['end'], $area, true, $units);

        if (empty($activeFilter['start']) && !empty($activeFilter['end'])) {
            return '<'.$activeFilter['end'];
        } elseif (!empty($activeFilter['start']) && empty($activeFilter['end'])) {
            $unit = $area ? Yii::t("RealtyModule.realty", 'га.') : RealtyOffer::EURO;

            if ($units) {
                $unit = Yii::t('RealtyModule.realty', $units,
                    array($activeFilter['start']));
            }

            return '>'.$activeFilter['start'].' '.$unit;
        } elseif(!empty($activeFilter['start']) && !empty($activeFilter['end'])) {
            return $activeFilter['start'].'-'.$activeFilter['end'];
        }

        return $activeFilter;
    }

    public function formatRoomFilter($activeFilter)
    {
        if (empty($activeFilter['start']) && !empty($activeFilter['end'])) {
            return $activeFilter['end'].' '.$this->getRoomUnit($activeFilter['end']);
        } elseif (!empty($activeFilter['start']) && empty($activeFilter['end'])) {
            return '>'.$activeFilter['start'].' '.$this->getRoomUnit($activeFilter['end']);
        } elseif(!empty($activeFilter['start']) && !empty($activeFilter['end'])) {
            return $activeFilter['start'].'-'.$activeFilter['end'].' '.$this->getRoomUnit($activeFilter['end']);
        }

        return $activeFilter;
    }

    private function getRoomUnit($count)
    {
        return Yii::t("RealtyModule.realty", 'комната|комнаты|комнат', array($count));
    }

    private function filterUnits($param, $area, $end = false, $units)
    {
        $unit = '';
        if ($param == 0) {
            return $param;
        }

        if ($area && $param >= 10000) {
            $param = round($param/10000, 1);

            if ($end) {
                $unit = Yii::t("RealtyModule.realty", 'га.');
            }
        } elseif($area && $end) {
            $unit = Yii::t("RealtyModule.realty", 'кв.м');
        } elseif ($end) {
            $unit = RealtyOffer::EURO;
        }

        if ($units && $end) {
            $unit = Yii::t('RealtyModule.realty', $units,
                array($param));
        }
        return $param.' '.$unit;
    }

    public function getAreaFilter($value = null)
    {
        if (isset($_POST['realtyType'])) {
            if(is_array($_POST['realtyType'])){
                $postFilter = array_values($_POST['realtyType']);
                $postFilter = array_filter($postFilter);
            }else{
                $postFilter = ($_POST['realtyType'])?array($_POST['realtyType']):array();
            }
        }

//        if (isset($postFilter) && (in_array('estate', $postFilter) || in_array('apartments', $postFilter))) {
//            $realtyType['1'] = Yii::t("RealtyModule.realty", '1 комната');
//            $realtyType['2'] = Yii::t("RealtyModule.realty", '2 комнаты');
//            $realtyType['3'] = Yii::t("RealtyModule.realty", '3 комнаты');
//            $realtyType['4'] = Yii::t("RealtyModule.realty", '4 комнаты');
//            $realtyType['>4'] = Yii::t("RealtyModule.realty", 'больше 4-x комнат');
//        } else {
            $realtyType['<'.(5* 4046.86)] = Yii::t("RealtyModule.realty", 'До 5-ти ар');
            $realtyType[(5* 4046.86).'-'. (10* 4046.86)] = Yii::t("RealtyModule.realty", '5 - 10 ар');
            $realtyType[(10* 4046.86).'-'. (50* 4046.86)] = Yii::t("RealtyModule.realty", '10 - 50 ар');
            $realtyType[(50* 4046.86).'-'. (100* 4046.86)] = Yii::t("RealtyModule.realty", '50 - 100 ар');
            $realtyType['10000-100000'] = Yii::t("RealtyModule.realty", '1-10 га');
            $realtyType['>100000'] = Yii::t("RealtyModule.realty", 'Больше 10 га');
//        }

        if ($value) {
            return $realtyType[$value];
        }

        return $realtyType;
    }

    /**
     * Метраж
     * @param null $value
     * @return mixed
     */
    public function getSquareFilter($value = null)
    {
        $realtyType['<50'] = Yii::t("RealtyModule.realty", 'До 50 м2');
        $realtyType['50-100'] = Yii::t("RealtyModule.realty", '50-100 м2');
        $realtyType['100-200'] = Yii::t("RealtyModule.realty", '100-200 м2');
        $realtyType['>200'] = Yii::t("RealtyModule.realty", 'Больше 200 м2');


        if ($value) {
            return $realtyType[$value];
        }

        return $realtyType;
    }

    public function getMoneyFilter($value = null)
    {
        if (isset($_POST['realtyOffer'])) {
            if(is_array($_POST['realtyOffer'])){
                $postFilter = array_values($_POST['realtyOffer']);
                $postFilter = array_filter($postFilter);
            }else{
                $postFilter = ($_POST['realtyOffer'])?array($_POST['realtyOffer']):array();
            }
        }

        if (isset($postFilter) && in_array('rent', $postFilter) && count($postFilter) == 1) {
            $realtyType['<150'] = Yii::t("RealtyModule.realty", 'До 150'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['150-300'] = Yii::t("RealtyModule.realty", '150-300'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['300-500'] = Yii::t("RealtyModule.realty", '300-500'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['500-1000'] = Yii::t("RealtyModule.realty", '500-1 000'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['1000-10000'] = Yii::t("RealtyModule.realty", '1000-10 000'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['>10000'] = Yii::t("RealtyModule.realty", 'Больше 10 000'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
        } else {
            $realtyType['<10000'] = Yii::t("RealtyModule.realty", 'До 10 000'). '€';
            $realtyType['10000-30000'] = Yii::t("RealtyModule.realty", '10-30 000'). '€';
            $realtyType['30000-70000'] = Yii::t("RealtyModule.realty", '30-70 000'). '€';
            $realtyType['70000-200000'] = Yii::t("RealtyModule.realty", '70-200 000'). '€';
            $realtyType['>500000'] = Yii::t("RealtyModule.realty", 'Больше 500 000'). '€';
        }


        if ($value) {
            return $realtyType[$value];
        }

        return $realtyType;
    }

    public function getMoneyFilterForOfferChange($value)
    {
        if ($value == RealtyOffer::RENT) {
            $realtyType['<150'] = Yii::t("RealtyModule.realty", 'До 150'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['150-300'] = Yii::t("RealtyModule.realty", '150-300'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['300-500'] = Yii::t("RealtyModule.realty", '300-500'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['500-1000'] = Yii::t("RealtyModule.realty", '500-1 000'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['1000-10000'] = Yii::t("RealtyModule.realty", '1 000-10 000'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
            $realtyType['>10000'] = Yii::t("RealtyModule.realty", 'Больше 10 000'). '€' .  ' / ' . Yii::t("MainModule.main", "месяц");
        } else {
            $realtyType['<10000'] = Yii::t("RealtyModule.realty", 'До 10 000'). '€';
            $realtyType['10000-30000'] = Yii::t("RealtyModule.realty", '10-30 000'). '€';
            $realtyType['30000-70000'] = Yii::t("RealtyModule.realty", '30-70 000'). '€';
            $realtyType['70000-200000'] = Yii::t("RealtyModule.realty", '70-200 000'). '€';
            $realtyType['>500000'] = Yii::t("RealtyModule.realty", 'Больше 500 000'). '€';
        }
        return $realtyType;
    }

    /**
     * Заполнить фильтр "мин. цена"
     * @param null $value
     * @return mixed
     */
    public function getMinMoneyFilter($value = null)
    {
//        $realtyType = array('0'=>Yii::t("MainModule.main", 'Все'));
        if (isset($_POST['realtyOffer'])) {
            if(is_array($_POST['realtyOffer'])){
                $postFilter = array_values($_POST['realtyOffer']);
                $postFilter = array_filter($postFilter);
            }else{
                $postFilter = ($_POST['realtyOffer'])?array($_POST['realtyOffer']):array();
            }
        }

        if (isset($postFilter) && in_array('rent', $postFilter) && count($postFilter) == 1) {
            for ($i = 0; $i <= 1000; $i+=50){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €' .  '/' . Yii::t("MainModule.main", "месяц");
            }
        } else {
            for ($i = 0; $i <= 100000; $i+=5000){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €';
            }
        }


        if ($value) {
            return $realtyType[$value];
        }

        return $realtyType;
    }

    public function getMaxMoneyFilter($value = null)
    {
//        $realtyType = array('0'=>Yii::t("MainModule.main", 'Все'));
        if (isset($_POST['realtyOffer'])) {
            if(is_array($_POST['realtyOffer'])){
                $postFilter = array_values($_POST['realtyOffer']);
                $postFilter = array_filter($postFilter);
            }else{
                $postFilter = ($_POST['realtyOffer'])?array($_POST['realtyOffer']):array();
            }
        }

        if (isset($postFilter) && in_array('rent', $postFilter) && count($postFilter) == 1) {
            for ($i = 0; $i <= 1000; $i+=50){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €' .  '/' . Yii::t("MainModule.main", "месяц");
            }
        } else {
            for ($i = 0; $i <= 100000; $i+=5000){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €';
            }
        }


        if ($value) {
            return $realtyType[$value];
        }

        return $realtyType;
    }

    public function getMinMoneyFilterForOfferChange($value)
    {
//        $realtyType = array('0'=>Yii::t("MainModule.main", 'Все'));
        if ($value == RealtyOffer::RENT) {
            for ($i = 0; $i <= 1000; $i+=50){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €' .  '/' . Yii::t("MainModule.main", "месяц");
            }
        } else {
            for ($i = 0; $i <= 100000; $i+=5000){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €';
            }
        }
        return $realtyType;
    }

    public function getMinMaxMoneyFilterForOfferChange($value)
    {
//        $realtyType = array('0'=>Yii::t("MainModule.main", 'Все'));
        if ($value == RealtyOffer::RENT) {
            for ($i = 0; $i <= 1000; $i+=50){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €' .  '/' . Yii::t("MainModule.main", "месяц");
            }
        } else {
            for ($i = 0; $i <= 100000; $i+=5000){
                if($i == 0){
                    continue;
                }
                $realtyType[$i] = $i. ' €';
            }
        }
        return $realtyType;
    }

}