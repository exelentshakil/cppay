<?php
namespace CP\Pay;

class Admin {

    /**
     * Class constructor.
     */
    public function __construct() {

        $payment = new Admin\Payment();
        new Admin\Menu( $payment );
    }
}