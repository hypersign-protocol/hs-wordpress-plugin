<?php

include "challenge.php";
include "credential.php";

function wtnerd_global_vars() {

	global $challengeStore;
	$challengeStore = array(
        
    );

}
add_action( 'init', 'wtnerd_global_vars' );


new Challenge("hypersign/v1", "/challenge", "GET");
new Credential("hypersign/v1", "/auth", "GET");

?>