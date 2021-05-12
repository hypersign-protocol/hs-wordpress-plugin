<?php
// do it in better way
require $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/hs-wordpress-plugin/utils/config.php';


/**
 * This is our callback function that embeds our phrase in a WP_REST_Response
 */
function prefix_get_endpoint_phrase()
{
    $configInstance = Config::getInstance();
    $appSetting = $configInstance->getAPPSetting();

    $data = array(
        "status" => 200,
        "message" =>  null,
        "error" => null
    );

    // Call external API 
    $challenge = $configInstance->get(Config::URL_AUTH_DID);

    if (empty($challenge) || is_null($challenge)) {
        $data["status"] = 400;
        $data["error"] =  "Could not fetch challenge";
    } else {

        $data["message"] = $challenge;
    }

    return rest_ensure_response($data);
}

/**
 * This function is where we register our routes for our example endpoint.
 */
function prefix_register_example_routes()
{
    // register_rest_route() handles more arguments but we are going to stick to the basics for now.
    register_rest_route('hypersign/v1', '/challenge', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => WP_REST_Server::READABLE,
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase',
    ));
}

add_action('rest_api_init', 'prefix_register_example_routes');
