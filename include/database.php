<?php
require_once('config.php');
$db_link = mysqli_connect($DB_URL, $DB_USER, $DB_PASS, $DB_NAME);

if(!$db_link) die('Database connection not established!');

?>
