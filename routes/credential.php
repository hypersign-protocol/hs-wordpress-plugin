<?php
// do it in better way
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/hs-wordpress-plugin/utils/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/hs-wordpress-plugin/utils/userManager.php';
require_once "IRoutes.php";

class Credential implements IRoutes
{

    private $namespace;
    private $route;
    private $method;
    private $userManager;
    public function __construct($namespace, $route, $method)
    {
        $this->namespace = $namespace;
        $this->route = $route;
        $this->method = $method;
        $this->userManager = new UserManager();
        add_action('rest_api_init', [$this, "registerRoute"]);
    }

    function controller(WP_REST_Request $request)
    {
        
        $configInstance = Config::getInstance();
        
        $appSetting = $configInstance->getAPPSetting();
        $storeInstance = $configInstance->getStoreInstance();


        $body = $request->get_json_params();
        $challenge = $body['challenge'];

        // Call external API 
        // user data comes from VP
        $user = $configInstance->request("POST", Config::URL_HS_CREDENTIAL, $body, null);
        

        // Check if this user exists in the db
        // if not create user and fetch the user_id
        // if yes fetch the user_id`
        // $res = $storeInstance->get($challenge);
        $isUserCreated = $this->userManager->addUser(
            $user["hs_userdata"]["name"],
            $user["hs_userdata"]["email"]
         );
        

        // put the user_id in the challeneStore wrt isVerfied 
        $data = array();
        $data["isVerifed"] = true;
        $data["userId"] = $isUserCreated[1];
        $storeInstance->set($challenge,  $data);


        $resp_data = array(
            "status" => 200,
            "message" => "success",
            "error" => null
        );
        
        return rest_ensure_response($resp_data);
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