<?php
// do it in better way
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/hs-wordpress-plugin/utils/config.php';
require_once "IRoutes.php";

class Challenge implements IRoutes
{

    private $namespace;
    private $route;
    private $method;
    public function __construct($namespace, $route, $method)
    {
        $this->namespace = $namespace;
        $this->route = $route;
        $this->method = $method;
        add_action('rest_api_init', [$this, "registerRoute"]);
    }

    function controller($data)
    {
        $yourvar = array();
        

        $configInstance = Config::getInstance();
        $appSetting = $configInstance->getAPPSetting();
        $storeInstance =  $configInstance->getStoreInstance();

        $resp_data = array(
            "status" => 200,
            "message" =>  null,
            "error" => null
        );

        // Call external API 
        $challenge = $configInstance->get(Config::URL_AUTH_DID);
        
        // storing into local storage
        $storeInstance->set($challenge, "stored_in_store");
        $res = $storeInstance->get($challenge);

        if (empty($challenge) || is_null($challenge)) {
            $resp_data["status"] = 400;
            $resp_data["error"] =  "Could not fetch challenge";
        } else {

            $resp_data["message"] = $challenge;
        }

        return rest_ensure_response( [ $res]);
    }


    public function registerRoute()
    {
        register_rest_route($this->namespace, $this->route, array(
            'methods'  => $this->method,
            'callback' => [$this, 'controller'],
        ));
    }
}


?>