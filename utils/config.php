<?php

include "apiSetting.php";
include "restClient.php";
require_once "storeManager.php";

interface IConfig
{
    public function getAPPSetting();
    public function getStoreInstance();
    
}


/**
 * Prevent access to wp-login.php
 *
 * @return void
 */



// Config is singleton class: only one object of this class can be created
class Config extends RestClient  implements IConfig
{
    public const URL_AUTH_DID = "https://ssi.hypermine.in/hsauth/hs/api/v2/authdid";
    public const URL_HS_SESSION = "http://192.168.43.43:3003/hs/api/v2/newsession";
    public const URL_HS_CREDENTIAL = "http://192.168.43.43:3003/hs/api/v2/auth";
    
    private $app_setting;
    private $store;
    private static $instance = null;

    private function __construct()
    {
        
        $hypersign_plugin_api_setting_options = get_option('hypersign_api_setting_option_name');

        $this->app_setting = array(
            "APP_ID" => $hypersign_plugin_api_setting_options['app_id_0'],
            "APP_SECRET" => $hypersign_plugin_api_setting_options['app_secret_1'],
            "REDIRECT_URI" => $hypersign_plugin_api_setting_options["after_login_2"],
            "LOCK_ACCESS" => $hypersign_plugin_api_setting_options["lock_access_to_wp_login_php_3"]
        );


        $this->store =  new Store();

        if ( $this->app_setting["LOCK_ACCESS"] ) {
            add_action( 'init', array( $this, 'hs_prevent_wp_login' ));
        }
    }

    private function hs_prevent_wp_login() {

        global $pagenow;
    
        $action = ( isset( $_GET['action'] ) ) ? $_GET['action'] : '';
    
        if ( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array( $action, array( 'logout', 'lostpassword', 'rp', 'resetpass', 'postpass' ) ) ) ) ) {
            $page = wp_login_url();
            wp_safe_redirect( $page );
            exit();
        }
    }
    
    public static function getInstance()
    {
        
        if (self::$instance == null) {
            self::$instance =  new Config();
        }

        return self::$instance;
    }

    public function getAPPSetting()
    {
        
        return  $this->app_setting;
    }

    public function getStoreInstance(){
        return $this->store;
    }
}


?>
