<?php
namespace CP\Pay;

class Frontend {
    /**
     * Class constructor loading all the frontend related code
     */
    public function __construct() {
        new Frontend\Shortcode();
    }
}