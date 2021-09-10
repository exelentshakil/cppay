<?php
/**
 * Plugin Name:       CPPay - ContentPress Payment Handler
 * Plugin URI:        https://jlouis.com
 * Description:       A WordPress plugin to handle ContentPress payment.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            J.Louis
 * Author URI:        https://jlouis.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cppay
 * Domain Path:       /languages
 */

// Don't call this file directly

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CpPay {

    /**
     * Plugin version
     *
     * @var string
     */

    public $version = '1.0';

    /**
     * Class constructor.
     */
    public function __construct() {

        require_once __DIR__ . '/vendor/autoload.php';

        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'active'] );
        register_deactivation_hook( __FILE__, [$this, 'deactive'] );
        add_action( 'plugins_loaded', [$this, 'plugins_loaded'] );
    }

    public function plugins_loaded() {

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new CP\Pay\Ajax();
        }

        if ( is_admin() ) {
            new CP\Pay\Admin();
        } else {
            new CP\Pay\Frontend();
        }

        new CP\Pay\Assets();

    }

    public function define_constants() {
        define( 'CP_PAY_VERSION', $this->version );
        define( 'CP_PAY_FILE', __FILE__ );
        define( 'CP_PAY_PATH', dirname( CP_PAY_FILE ) );
        define( 'CP_PAY_URL', plugins_url( '', CP_PAY_FILE ) );
        define( 'CP_PAY_ASSETS', CP_PAY_URL . '/assets' );
    }

    public function active() {

        $installer = new CP\Pay\Installer();
        $installer->run();
        $this->i18n();
    }

    public function i18n() {
        load_plugin_textdomain(
            'cppay',
            false,
            CP_PAY_PATH . '/languages/'
        );
    }
    public function deactive() {}
    /**
     * Initialize singleton
     *
     * @return \CpPay
     */
    public static function init() {

        static $instance = false;

        if ( ! $instance ) {
            $instance = new CpPay();
        }

        return $instance;
    }

}

function cppay() {
    return CpPay::init();
}

// hook plugin with world
cppay();