<?php

$path_controller_registration = realpath(__DIR__ . "\\..\\classes\\class_controller_registration.php");
include_once( $path_controller_registration );
$controller_registration = new UserRegistration();

?>
