<?php
namespace CP\Pay\Admin;

class Menu {

    /**
     * Auction settings
     *
     * @var \Payment
     */
    private $payment;

    /**
     * Class constructor.
     */
    public function __construct(Payment $payment ) {

        $this->payment = $payment;
        add_action( 'admin_menu', [$this, 'admin_menu'] );
    }

    public function admin_menu() {

        $capabilities = 'manage_options';
        $slug         = 'cppay';
        $icon         = 'dashicons-list-view';

        $hook = add_menu_page( __( 'CP Pay', 'cppay' ), __( 'CP Pay', 'cppay' ), $capabilities, $slug, [$this->payment, 'menu_page'], $icon );
        add_submenu_page( $slug, __( 'CP Pay', 'cppay' ), __( 'CP Pay', 'cppay' ), $capabilities, $slug, [$this->payment, 'menu_page'], $icon );


        add_action( 'load-' . $hook, [$this, 'menu_script'] );
    }

    public function menu_script() {
        add_action( 'admin_enqueue_scripts', [$this, 'menu_enqueue_scripts'] );
    }

    public function menu_enqueue_scripts() {
        wp_enqueue_style( 'main' );
        wp_enqueue_script( 'main' );
        wp_enqueue_script( 'swal' );
    }

}