<?php

require_once 'config.php';
require_once 'Models/Database.php';

$database = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$connection = $database->connect();

require_once 'router.php';

$database->disconnect();

?>