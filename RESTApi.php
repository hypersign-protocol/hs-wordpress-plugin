<?php

// ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

function my_awesome_func( $data ) {
    return "Hello user!";
    // $posts = get_posts( array(
    //   'author' => $data['id'],
    // ) );
   
    // if ( empty( $posts ) ) {
    //   return null;
    // }
   
    // return $posts[0]->post_title;
  } 


  // http://192.168.43.43/index.php/wp-json/myplugin/v1/author
  add_action( 'rest_api_init', function () {
    register_rest_route( 'myplugin/v1', '/author', array(
      'methods' => 'GET',
      'callback' => 'my_awesome_func',
    ) );
  } );


?>