<?php

function create_login_page_post(){

    $user_id = get_current_user_id();
 
    // Gather post data.
$my_post = array(
    'post_title'    => 'Hypersign Login page',
    'post_content'  => '[hypersign]',
    'post_status'   => 'publish',
    'post_author'   => $user_id,
    'post_type'     => 'page',
    'post_category' => array( 8,39 )
);
// https://developer.wordpress.org/reference/functions/wp_insert_post/
$post_id = wp_insert_post( $my_post );


if(!is_wp_error($post_id)){
    //the post is valid
    echo $post_id ;
  }else{
    //there was an error in the post insertion, 
    echo $post_id->get_error_message();
  }
}




?>