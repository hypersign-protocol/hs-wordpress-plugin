<?php

include "apiSetting.php";
include "restClient.php";
require_once "storeManager.php";

interface IConfig
{
    public function getAPPSetting();
    public function getStoreInstance();
    
}

// Config is singleton class: only one object of this class can be created
class Config extends RestClient  implements IConfig
{
    public const URL_AUTH_DID = "https://ssi.hypermine.in/hsauth/hs/api/v2/authdid";
    public const URL_HS_CREDENTIAL = "https://ssi.hypermine.in/hsauth/hs/api/v2/authdid";
    private $app_setting;
    private $store;
    private static $instance = null;

    private function __construct()
    {
        
        $hypersign_plugin_api_setting_options = get_option('hypersign_plugin_api_setting_option_name');

        $this->app_setting = array(
            "APP_ID" => $hypersign_plugin_api_setting_options['app_id_0'],
            "APP_SECRET" => $hypersign_plugin_api_setting_options['app_secret_1']
        );

        $this->store =  new Store();
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
