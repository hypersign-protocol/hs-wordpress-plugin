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

    public function controller(WP_REST_Request $request)
    {
        $configInstance = Config::getInstance();
        $appSetting = $configInstance->getAPPSetting();
        $storeInstance =  $configInstance->getStoreInstance();

        $resp_data = array(
            "status" => 200,
            "message" =>  null,
            "error" => null
        );

        $body = array("baseUrl" => "http://192.168.43.43/index.php/wp-json/");

        // Call external API 
        $qrData = $configInstance->request("POST", Config::URL_HS_SESSION, $body, null);

        $challenge = $qrData["challenge"];
        
        // // storing into local storage
        $storeInstance->set($challenge, array(
            "isVerifed" => false,
            "user" => array()
        ));
        

        // if (empty($challenge) || is_null($challenge)) {
        //     $resp_data["status"] = 400;
        //     $resp_data["error"] =  "Could not fetch challenge";
        // } else {

        //     $resp_data["message"] = $challenge;
        // }

        // $resp_data["result"] = $storeInstance->get($challenge);
        
        return rest_ensure_response( $qrData );
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