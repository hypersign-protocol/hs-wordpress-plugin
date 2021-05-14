<?php
//Ref: https://developer.wordpress.org/apis/handbook/transients/
interface IStore{
    public function set($key, $value);
    public function get($key);
    public function delete($key);
}

class Store implements IStore{

    public function __construct()
    {
        
    }

    public function set($key, $value){
        set_transient( $key, $value, 12 * HOUR_IN_SECONDS );
        return true;
    }

    public function get($key){
        return get_transient( $key );
    }

    public function delete($key)
    {
        delete_transient($key);
        return true;
    }

}


?>