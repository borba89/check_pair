<?php
class BottomMenu extends  CWidget
{
    public $filter = false;
    public $favorite = false;
    public $phone = false;

    public function run() {
        $this->render(
            "bottom-menu",
            array(
                'filter' => $this->filter,
                'favorite' => $this->favorite,
                'phone' => $this->phone
            )
        );
    }
}