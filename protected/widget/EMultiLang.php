<?php
class EMultiLang extends  CWidget
{
    public $mobile = false;

    public function run() {
        if ($this->mobile) {
            $this->render("e-mobile-lang", array('mobile' => $this->mobile));
        } else {
            $this->render("e-lang", array('mobile' => $this->mobile));
        }
    }
}