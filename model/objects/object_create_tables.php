<?php

$path_class_create_tables = realpath(__DIR__ . "\\..\\classes\\class_create_tables.php");
include_once( $path_class_create_tables );
$create_tables = new CreateTables();

?>
