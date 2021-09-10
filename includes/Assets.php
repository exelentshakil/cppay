<?php
namespace CP\Pay;

class Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this, 'common_scripts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'common_scripts'] );

    }

    public function common_scripts() {
        // Default
        wp_enqueue_script( 'wp-util' );
        wp_enqueue_script( 'jquery-ui-mouse' );
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'jquery-ui-slider' );
        wp_enqueue_script( 'jquery-datetimepicker-min' );


        // custom scripts
        wp_enqueue_style( 'main' );
        wp_enqueue_script( 'stepper' );

        wp_localize_script( 'stepper', 'cppay', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'easy_coupons_nonce' ),
        ] );
    }

    public function enqueue_scripts() {
        $styles  = $this->get_styles();
        $scripts = $this->get_scripts();

        $this->register_styles( $styles );
        $this->register_scripts( $scripts );
    }

    public function register_styles( $styles ) {

        foreach ( $styles as $handle => $style ) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version'] : '1.0';
            wp_register_style( $handle, $style['src'], $deps, $version );
        }

    }

    public function register_scripts( $scripts ) {

        foreach ( $scripts as $handle => $script ) {
            $deps    = isset( $script['deps'] ) ? $script['deps'] : [];
            $version = isset( $script['version'] ) ? $script['version'] : '1.0';

            wp_register_script( $handle, $script['src'], $deps, $version, true );
        }

    }

    public function get_styles() {

        return [
            'main'         => [
                'src'     => CP_PAY_ASSETS . '/css/main.css',
                'version' => filemtime( CP_PAY_PATH . '/assets/css/main.css' ),
                'deps'    => ['bootstrap', 'fontawesome'],
            ],
            'bootstrap'         => [
                'src'     => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
                'version' => 3.36,
                'deps'    => ['fontawesome'],
            ],
            'fontawesome'         => [
                'src'     => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
                'version' => 4.1,
                'deps'    => [],
            ]
        ];

    }

    public function get_scripts() {

        return [
            'main'  => [
                'src'     => CP_PAY_ASSETS . '/js/main.js',
                'version' => filemtime( CP_PAY_PATH . '/assets/js/main.js' ),
                'deps'    => ['jquery', 'datatables', 'swal'],
            ],
            'stepper'  => [
                'src'     => CP_PAY_ASSETS . '/js/stepper.js',
                'version' => filemtime( CP_PAY_PATH . '/assets/js/stepper.js' ),
                'deps'    => ['jquery', 'swal'],
            ],
            'swal'  => [
                'src'     => 'https://cdn.jsdelivr.net/npm/sweetalert2@10',
                'version' => 2.1,
                'deps'    => ['jquery'],
            ],
            'stripe'  => [
                'src'     => 'https://js.stripe.com/v2/',
                'version' => 2,
                'deps'    => ['jquery'],
            ],
        ];

    }

}