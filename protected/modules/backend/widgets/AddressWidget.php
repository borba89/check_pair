<?php

class AddressWidget extends CWidget
{
    public $address;
    public $form;
    public $view = 'address-view';

    public function run()
    {
        if($this->address)
            $this->render($this->view, array('address' => $this->address));
    }
}