<?php

class ExcelController extends BackendController
{
    public $sidebar_tab = "content";
    public function actionExcel()
    {
        ini_set('max_execution_time', 0);
        ini_set("memory_limit","-1");

        $date = null;
        $code = null;
        if (isset($_FILES["User"]["tmp_name"]["file"])) {
            if (is_uploaded_file($_FILES["User"]["tmp_name"]["file"])) {
                $filename = $_FILES["User"]["name"]["file"];
                $type = explode('.', $filename);
                if ($type[count($type) - 1] != 'xlsx') {
                    Yii::app()->user->setFlash('error', Yii::t("main", "The file must be in xlsx format"));
                    $this->redirect(Yii::app()->request->urlReferrer);
                } else {
                    move_uploaded_file($_FILES["User"]["tmp_name"]["file"], "files/" . $filename);
                    Yii::import('ext.phpexcel.Classes.PHPExcel',true);
                    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                    $objPHPExcel  = $objReader->load('files/' . $filename);

                    $objWorksheet = $objPHPExcel->getActiveSheet();
                    $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
                    $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

                    for ($i = 2; $i <= $highestRow; $i++) {
                        $address = array();
                        $model = new User();
                        for ($y = 0; $y < $highestColumnIndex; $y++) {
                            $item = @trim($objWorksheet->getCellByColumnAndRow($y, $i)->getValue());

                            if ($y >= 21 && $y <= 40)
                                $address[$this->typeId($y)][$this->titleId($y)] = $item;

                            elseif ($y >= 54 && $y <= 63)
                                $address[$this->typeId($y)][$this->titleId($y)] = $item;

                            elseif ($this->titleId($y)) {
                                if ($y == 8 || $y == 10)
                                    $item = YHelper::formatDate('yyyy-MM-dd', $item, 'dd.MM.yyyy');

                                $field = $this->titleId($y);
                                $model->$field = $item;
                            }
                        }

                        if ($model->save(false)) {
                            if ($address) {
                                foreach ($address as $type => $arr) {
                                    $address = new UserAddress();
                                    $address->type = $type;
                                    $address->user_id = $model->id;
                                    if (!empty($arr))
                                        foreach ($arr as $key => $field)
                                            $address->$key = $field;

                                    $address->save(false);
                                }
                            }
                            Yii::app()->user->setFlash(
                                FlashMessages::SUCCESS_MESSAGE(),
                                Yii::t("main", "Data was successfully introduced")
                            );
                        } else {
                            Yii::app()->user->setFlash(
                                FlashMessages::ERROR_MESSAGE(),
                                Yii::t("main", "An error occured")
                            );
                            $this->refresh();
                            die();
                        }
                    }
                }
            }
        }
        $modMyModel = new User();
        $this->render('excel', array('model' => $modMyModel));
    }

    public function actionTag()
    {
        ini_set('max_execution_time', 0);
        ini_set("memory_limit","-1");

        Yii::app()->db->createCommand()->truncateTable('statictics_category');
        StaticticsCategory::parseTag();
        Yii::app()->user->setFlash(
            FlashMessages::SUCCESS_MESSAGE(),
            Yii::t("main", "Tags were successfully introduced")
        );
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    private function typeId($id)
    {
        $arr = array(
            21 => UserAddress::DEF,
            22 => UserAddress::DEF,
            23 => UserAddress::DEF,
            24 => UserAddress::DEF,
            25 => UserAddress::DEF,

            26 => UserAddress::HOME,
            27 => UserAddress::HOME,
            28 => UserAddress::HOME,
            29 => UserAddress::HOME,
            30 => UserAddress::HOME,

            31 => UserAddress::POSTAL,
            32 => UserAddress::POSTAL,
            33 => UserAddress::POSTAL,
            34 => UserAddress::POSTAL,
            35 => UserAddress::POSTAL,

            36 => UserAddress::OFFICE,
            37 => UserAddress::OFFICE,
            38 => UserAddress::OFFICE,
            39 => UserAddress::OFFICE,
            40 => UserAddress::OFFICE,

            54 => UserAddress::OFFICE,
            55 => UserAddress::OFFICE,
            56 => UserAddress::OFFICE,
            57 => UserAddress::OFFICE,
            58 => UserAddress::OFFICE,

            59 => UserAddress::OFFICE,
            60 => UserAddress::OFFICE,
            61 => UserAddress::OFFICE,
            62 => UserAddress::OFFICE,
            63 => UserAddress::OFFICE,
        );

        return $arr[$id];
    }

    private function titleId($id)
    {
        $arr = array(
            0 => 'type',
            1 => 'old_id',
            2 => 'name',
            3 => 'title',
            5 => 'surname',
            6 => 'job_title',
            7 => 'organisation',
            8 => 'date_joined',
            10 => 'last_login',
            11 => 'email',
            14 => 'work_email',
            15 => 'phone',
            16 => 'home_phone',
            17 => 'work_phone',
            18 => 'mobile_phone',
            19 => 'fax_phone',
            20 => 'direct_phone',

            21 => 'address_street',
            22 => 'city',
            23 => 'state',
            24 => 'postcode',
            25 => 'country',

            26 => 'address_street',
            27 => 'city',
            28 => 'state',
            29 => 'postcode',
            30 => 'country',

            31 => 'address_street',
            32 => 'city',
            33 => 'state',
            34 => 'postcode',
            35 => 'country',

            36 => 'address_street',
            37 => 'city',
            38 => 'state',
            39 => 'postcode',
            40 => 'country',

            41 => 'sponsored',
            42 => 'ticket_kategorie',
            43 => 'bestell_nummer',
            44 => 'bezahlter_ticketpreis',
            45 => 'datenquelle',
            46 => 'tags',
            47 => 'website',
            49 => 'work_website',
            50 => 'facebook',
            51 => 'twitter',
            52 => 'skype',
            53 => 'linkedIn',

            54 => 'address_street',
            55 => 'city',
            56 => 'state',
            57 => 'postcode',
            58 => 'country',

            59 => 'address_street',
            60 => 'city',
            61 => 'state',
            62 => 'postcode',
            63 => 'country',
        );

        return $arr[$id];
    }
}