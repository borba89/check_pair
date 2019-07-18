<?php
class FlashMessages extends CWidget
{
    public $view = 'flashmessages';

    private static $count = 0;
    private static $success_message = 'success';
    private static $info_message = 'info';
    private static $warninng_message = 'warning';
    private static $error_message = 'error';

    public static function SUCCESS_MESSAGE() {
        return self::$success_message.self::$count++;
    }

    public static function INFO_MESSAGE() {
        return self::$info_message.self::$count++;
    }

    public static function WARNING_MESSAGE() {
        return self::$warninng_message.self::$count++;
    }

    public static function ERROR_MESSAGE() {
        return self::$error_message.self::$count++;
    }

    public function run()
    {
        $this->render($this->view);
    }
}