<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 11.03.19
 * Time: 22:55
 */

class Alert extends CWidget
{
    public $alertTypes = [
        'error'   => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];

    public function run()
    {
        $flashes = Yii::app()->user->getFlashes();

        foreach ($flashes as $key => $message) {
            if (!isset($this->alertTypes[$key])) {
                continue;
            }

            $message = str_replace(chr(13), '', $message);
            $message = str_replace(chr(10), '', $message);

            Yii::app()->clientScript->registerScript('alert-handler',
                '
                toastr.options = {
                    "positionClass": "toast-center",
                    };
                toastr.'.$key.'(\''.$message.'\')
                ', CClientScript::POS_READY);
        }
    }
}