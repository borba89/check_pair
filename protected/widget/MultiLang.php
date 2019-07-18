<?php
class MultiLang extends  CWidget
{
    public $mobile = false;

    public function run() {
        if ($this->mobile) {
            $this->render("mobile-lang", array('mobile' => $this->mobile));
        } else {
            $this->render("lang", array('mobile' => $this->mobile));
        }
    }
}