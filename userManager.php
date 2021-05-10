<?php

function add_new_user($user_name, $user_email){


    $user_id = username_exists( $user_name );
 
    // check that the email address does not belong to a registered user
    if ( ! $user_id && email_exists( $user_email ) === false ) {
        // create a random password
        $random_password = wp_generate_password( 12, false );
        // create the user
        $user_id = wp_create_user(
            $user_name,
            $random_password,
            $user_email
        );
    }
}



?>