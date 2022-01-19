<?php

require_once __DIR__."/classes/database_class.php";

$database_connection = database::getInstance();

var_dump($database_connection->checkSubs(5));