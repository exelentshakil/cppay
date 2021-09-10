<?php
namespace CP\Pay;

class Installer {

    public function run() {
        $this->update_version();
    }

    public function update_version() {

        $installed = get_option( 'cppay_installed' );

        if ( $installed ) {
            update_option( 'cppay_installed', time() );
        }

        update_option( 'cppay_version', CP_PAY_VERSION );
    }

}