<?php

include "challenge.php";
include "credential.php";


new Challenge("hypersign/v1", "/challenge", "GET");
new Credential("hypersign/v1", "/auth", "GET");

?>