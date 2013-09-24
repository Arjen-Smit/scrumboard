<?php

/**
 * Not much to be done here right now, loading the Helix Class
 * 
 * @todo remove this file and resolve this with the .htaccess
 */

include_once __DIR__ . "/../Helix/Helix.php";

$helix = new Helix(true);
$helix->init();
$helix->run();
