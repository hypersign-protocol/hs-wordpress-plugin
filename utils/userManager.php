<?php


interface IUserManger{
    public function addUser($user_name, $user_email);
}

class UserManager implements IUserManger{

    public function __construct()
    {
        
    }

    public function addUser($user_name, $user_email){
        $user_id = email_exists($user_email);
    
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
            // wp_authenticate($user_name, $random_password);
            // wp_authenticate_email_password($user_name, $user_email, $random_password);
            return [true, $user_id];
        }else{
            // user is already created
            // so do nothing.
            return [false, $user_id];
        }
    }


}




?>