<?php


// Ref: https://developer.wordpress.org/plugins/http-api/

function get_did(){
    $url = "https://ssi.hypermine.in/hsauth/hs/api/v2/authdid";

    $response = wp_remote_get( $url );
    $http_code = wp_remote_retrieve_response_code( $response );
    if($http_code == 200){
        
    } 


    $body = wp_remote_retrieve_body( $response );
        
    return $body;
}


?>