<?php

$path_class_database_connector = realpath( __DIR__ . "\\..\\classes\\class_database_connector.php" );
include_once( $path_class_database_connector );
$database_connector = new ConnectToDatabase();

?>
