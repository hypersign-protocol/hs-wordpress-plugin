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

    function controller($data)
    {
        
        $configInstance = Config::getInstance();
        
        $appSetting = $configInstance->getAPPSetting();
        $storeInstance = $configInstance->getStoreInstance();

        $resp_data = array(
            "status" => 200,
            "message" =>  null,
            "error" => null
        );

        // Call external API 
        $challenge = $configInstance->get(Config::URL_HS_CREDENTIAL);

        if (empty($challenge) || is_null($challenge)) {
            $resp_data["status"] = 400;
            $resp_data["error"] =  "Could not fetch challenge";
        } else {
            $resp_data["message"] = $challenge;
        }


        // user data comes from VP

        // Check if this user exists in the db
        // if not create user and fetch the user_id
        // if yes fetch the user_id`
        $res = $storeInstance->get($challenge);
        
        $res["isVerifed"] =  true;
        $res["user"]["name"] = "vishwas6";
        $res["user"]["email"] = "vishwas6@hypermine.in";

        $isUserCreated = $this->userManager->addUser(
            $res["user"]["name"],
            $res["user"]["email"]
         );
        $res["user"]["id"] = $isUserCreated[1];

        // put the user_id in the challeneStore wrt isVerfied 
        $data = array();
        $data["isVerifed"] =  true;
        $data["userId"] =  $isUserCreated[1];

        $storeInstance->set($challenge,  $data);


        // $res = $storeInstance->get($challenge);
        
        return rest_ensure_response([$res, $data]);
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