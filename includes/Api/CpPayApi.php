<?php
namespace CP\Pay\Api;

class CpPayApi {

    /** @var string $base the route base */
    protected $base = '/easy-coupons';

    /**
     * Register the routes for this class
     *
     * GET/POST /coupons
     * GET /coupons/count
     * GET/PUT/DELETE /coupons/<id>
     *
     * @since 2.1
     * @param array $routes
     * @return array
     */
    public function register_routes() {
        # GET/POST /products
        $routes[$this->base] = array(
            array( array( $this, 'get_users' ), WC_API_Server::READABLE ),
            array( array( $this, 'create_users' ), WC_API_SERVER::CREATABLE | WC_API_Server::ACCEPT_DATA ),
            array( array( $this, 'update_users' ), WC_API_SERVER::EDITABLE | WC_API_Server::ACCEPT_DATA ),
        );
    }

    // TODO
    public function get_users() {}
    public function create_users() {}
    public function update_users() {}


}