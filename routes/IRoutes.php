<?php

interface IRoutes{
    public function controller(WP_REST_Request $request);
    public function registerRoute();
}

?>