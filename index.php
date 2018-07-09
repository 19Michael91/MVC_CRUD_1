<?php

/**
 * Load files which includes objects.
 *
 */

include_once( __DIR__ . '\model\objects\object_database_connector.php' );
include_once( __DIR__ . '\model\objects\object_create_tables.php' );
include_once( __DIR__ . '\view\objects\object_view_registration.php' );
include_once( __DIR__ . '\controller\objects\object_controller_registration.php' );
include_once( __DIR__ . '\view\objects\object_view_login.php' );
include_once( __DIR__ . '\controller\objects\object_controller_login.php' );
include_once( __DIR__ . '\view\objects\object_view_profile_create.php' );
include_once( __DIR__ . '\controller\objects\object_controller_profile_data.php' );
include_once( __DIR__ . '\controller\objects\object_controller_profile_update.php' );

// Connect to database.

$database_connector->connect();

// Create tables.

$create_tables->createNewTables();


if( isset( $_REQUEST['registration_button'] ) ){

	// Registrate new user.

	$controller_registration->registeration( $_REQUEST['username_registration'],
											$_REQUEST['password_registration'],
											$view_registration,
											$view_profile_create,
											$view_login );

} elseif ( isset( $_REQUEST['redirect_login_button'] ) ) {

	// Show login form.

	echo $view_login->loginForm;

} elseif ( isset( $_REQUEST['login_button'] ) ){

	// User authorisation.

	$controller_login->userLogin( $_REQUEST['username_login'],
								$_REQUEST['password_login'],
								$view_login,
								$view_profile_create,
								$controller_profile_data );

} elseif ( isset( $_REQUEST['edit_profile_data'] ) ){

	// Edit profile data.

	if ( ! isset( $_REQUEST['update_profile_data']) ) {

		echo $controller_profile_update->returnProfile( $_REQUEST['edit_profile_data'] );

	} else {

		$controller_profile_update->updateDataProfile( $_REQUEST['profile_name'],
														$_REQUEST['profile_surname'],
														$_REQUEST['profile_email'],
														$_REQUEST['profile_description'],
														$_REQUEST['edit_profile_data'] );

	}

} else {

	echo $view_registration->registrationForm;

}

?>
