<?php

include "challenge.php";
include "credential.php";




new Challenge("hs/api/v2", "/challenge", "GET");
new Credential("hs/api/v2", "/auth", "POST");


?>