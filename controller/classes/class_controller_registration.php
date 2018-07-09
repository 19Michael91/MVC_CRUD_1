<?php

/**
 * CreateTables class used to registrate new user.
 *
 */

class UserRegistration
{

	/**
	 * Registrate new user.
	 *
	 * @param string    $name                 Users name.
	 * @param string    $password             Users password.
	 * @param object    $view_registration    View registration form.
	 * @param object    $view_profile_create  View profile form.
	 * @param object    $view_login           View login form.
	 */

	public function registeration( $name, $password, $view_registration, $view_profile_create, $view_login )

	{
		if ( ! function_exists( 'registeration' ) ){

			if( isset( $name ) && isset( $password ) ) {

				$name		= trim( htmlspecialchars( $name ) );
				$password	= trim( htmlspecialchars( $password ) );

				$name_validation		= preg_match( "/^[a-zA-Z0-9]+$/", $name );
				$password_validation	= preg_match( "/^[a-zA-Z0-9]+$/", $password );

				// Validate user name and password.

				if( ! $name_validation && "" != $name || ! $password_validation && "" != $password ) {
					echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* The "Name" and "Password" must consist only of Latin letters and numbers.</p>';
					echo  $view_registration->registrationForm;
					return false;
				}

				if( "" == $name || "" == $password ){
					echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* Fill in all the fields.</p>';
					echo  $view_registration->registrationForm;
					return false;
				}

				if ( 5 > strlen( $name ) || 5 > strlen( $password ) ){
					echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* The "Name" and "Password" must be at least 5 characters in length.</p>';
					echo $view_registration->registrationForm;
					return false;
				}

				$password = md5( $password . 'word' );

				$select = 'SELECT * from users';
				$result = mysql_query($select);

				while( $row = mysql_fetch_array( $result, MYSQL_ASSOC )){
					if ( $name == $row['login'] ){
						echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* This name already exists.</p>';
						echo $view_registration->registrationForm;
						return false;
					}
				}

				// Adding new user to database.

				$insert = 'INSERT into users (login, pass)
				values("' . $name . '","' . $password . '")';

				mysql_query( $insert );

				$error = mysql_errno();

				$select = 'SELECT * from users';
				$result = mysql_query($select);
				while( $row = mysql_fetch_array( $result, MYSQL_ASSOC )){
					$user_id = $row['id'];
				}

				if( 0 == $error ){
					echo '<p class="registration-message" style="margin: 10px 0; text-align: center;">You have been registered</p>';
					echo $view_login->loginForm;
				} else{
					echo '<p class="registration-message" style="margin: 10px 0; text-align: center; color: #f00;">Oops Something goes wrong</p>';
					return false;
				}

			}

		}

	}

}

?>
