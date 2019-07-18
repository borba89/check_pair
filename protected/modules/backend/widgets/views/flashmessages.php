<?php
$notify = '';
foreach(Yii::app()->user->getFlashes() as $status => $message) {
    if(strpos($status, 'success') !== false) {
        $notify = $this->createNotify('success', $message); }
    elseif(strpos($status, 'info') !== false)
        $notify = $this->createNotify('info', $message);
    elseif(strpos($status, 'error') !== false)
        $notify = $this->createNotify('error', $message);

    Yii::app()->clientScript->registerScript($status, $notify, CClientScript::POS_READY);
}