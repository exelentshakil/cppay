<?php
namespace CP\Pay\Admin;

class Payment {

    public function __construct()
    {

    }

    public function menu_page() {
        include __DIR__ . '/views/dashboard.php';
    }


}