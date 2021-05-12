<?php

// Ref: https://developer.wordpress.org/plugins/http-api/

interface IRestClient{

    public function get($url);
    public function post($url, $body, $headers);
    public function request($method, $url, $body, $headers);
}

Class RestClient implements IRestClient{

    public function __construct()
    {
         
    }


    private function getFormattedResposne($response_json){
        
        $parsedData = json_decode($response_json, true);
         
        return $parsedData["message"];
    }

    public function request($method, $url, $body, $headers){
         
        if(is_null($method)) throw new Error("Method can not null or empty");
        if(is_null($url)) throw new Error("Url can not be null or empty");
        // check for body and headers type -  should be arraay
        if(is_null($body)) $body = array();
        if(is_null($headers)) $headers = array();

        $args = array(
            'method'      => $method,
            'body'        => ((count($body) > 0 ) && ($method == "POST" || "PUT"))  ? $body : array() ,
            'timeout'     => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => count($headers) <= 0 ? array() : $headers,
            'cookies'     => array(),
        );


        $response = wp_remote_request( $url, $args );

        if(is_null($response)) throw new Error("Respose is null or empty");

        $http_code = wp_remote_retrieve_response_code( $response );
        if($http_code != 200) throw new Error("Error while fetching resource");

        $body = wp_remote_retrieve_body( $response );
        if(is_null($body)) throw new Error("Could not fetch data");
        
        return $this->getFormattedResposne($body);        
    }

    public function get($url)
    {
        
        $response = wp_remote_get( $url );
        $http_code = wp_remote_retrieve_response_code( $response );
        if($http_code != 200){
            throw new Error("Error while fetching resource");
        } 

        $body =  wp_remote_retrieve_body( $response );

        if(is_null($body)) throw new Error("Could not fetch data");
        
        return $this->getFormattedResposne($body);
    }


    public function post($url, $body, $headers){


        $args = array(
            'body'        => count($body) <= 0 ? array() : $body,
            'timeout'     => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => count($headers) <= 0 ? array() : $headers,
            'cookies'     => array(),
        );

        $response = wp_remote_post($url, $args );

        $http_code = wp_remote_retrieve_response_code( $response );
        if($http_code != 200){
            throw new Error("Error while fetching resource");
        } 

        $body =  wp_remote_retrieve_body( $response );

        if(is_null($body)) throw new Error("Could not fetch data");
        
        return $this->getFormattedResposne($body);





    }


}
