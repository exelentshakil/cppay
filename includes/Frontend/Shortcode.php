<?php
namespace CP\Pay\Frontend;

use CP\Pay\Traits\Features;

class Shortcode {

    use Features;

    /**
     * Class constructor.
     */
    public function __construct() {
        add_shortcode( 'cppay', [$this, 'render_shortcode'] );
    }

    public function render_shortcode( $atts, $content = '' ) {
        $atts = shortcode_atts( [
            'row' => '',
        ], $atts, 'cppay' );

        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui');
        wp_enqueue_script('stepper');
        wp_enqueue_script('stripe');

        wp_enqueue_style('main');
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('fontawesome');

        ob_start();

        include __DIR__ . '/views/pay.php';

        return ob_get_clean();
    }

}