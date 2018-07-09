<?php

/**
 * LoginForm class used to user login.
 *
 */

class LoginForm
{

	/**
	 * User authorisation.
	 *
	 * @param string $name                      Users name.
	 * @param string $password                  Users password.
	 * @param object $view_login                View login form.
	 * @param object $view_profile_create       View profile form..
	 * @param object $controller_profile_data   Save profile data.
	 *
	 */

	public function userLogin( $name, $password, $view_login, $view_profile_create, $controller_profile_data )
	{

		if ( ! function_exists( 'userLogin' ) ){

			if( isset( $name ) && isset( $password ) ) {

				$name		= trim( htmlspecialchars( $name ) );
				$password	= trim( htmlspecialchars( $password ) );

				$name_validation		= preg_match( "/^[a-zA-Z0-9]+$/", $name );
				$password_validation	= preg_match( "/^[a-zA-Z0-9]+$/", $password );

				// Validate authorisation data.

				if( ! $name_validation && "" != $name || ! $password_validation && "" != $password ) {
					echo '<p class="login-error" style="margin: 10px 0; text-align: center; color: #f00;">* The "Name" and "Password" must consist only of Latin letters and numbers.</p>';
					echo $view_login->loginForm;
					return false;
				}

				if( "" == $name || "" == $password ){
					echo '<p class="login-error" style="margin: 10px 0; text-align: center; color: #f00;">* Fill in all the fields.</p>';
					echo $view_login->loginForm;
					return false;
				}

				if ( 5 > strlen( $name ) || 5 > strlen( $password ) ){
					echo '<p class="login-error" style="margin: 10px 0; text-align: center; color: #f00;">* The "Name" and "Password" must be at least 5 characters in length.</p>';
					echo $view_login->loginForm;
					return false;
				}

				$password = md5( $password . 'word' );

				$select = 'SELECT * from users';
				$result = mysql_query($select);

				$concurrences = array();

				while( $row = mysql_fetch_array( $result, MYSQL_ASSOC )){
					if ( $name == $row['login'] ) {
						$user_id = $row['id'];
						$concurrences[] = $row;
					}
				}

				if ( ! empty( $concurrences ) ){
					foreach ($concurrences as $value) {
						if ( $name == $value['login'] && $password != $value['pass'] ){
							echo '<p class="login-error" style="margin: 10px 0; text-align: center; color: #f00;">* Password is wrong.</p>';
							echo $view_login->loginForm;
						}
						if ( $name == $value['login'] && $password == $value['pass'] ){
							$select4 = 'SELECT * from profiles WHERE user_id = "' . $user_id . '"';
							$result4 = mysql_query( $select4 );

							if( $result4 ){

								// Show profiles table if profile exist.

								$profiles_table = '<!DOCTYPE html>
														<html lang="en">
														<head>
															<meta charset="UTF-8">
															<title>Create Prolife</title>
															<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
														</head>
														<body>
															<table class="table">
																<thead class="thead-dark">
																	<tr>
																		<th scope="col">
																			Name
																		</th>
																		<th scope="col">
																			Surname
																		</th>
																		<th scope="col">
																			Email
																		</th>
																		<th scope="col">
																			Description
																		</th>
																		<th scope="col">
																			Avatar
																		</th>
																	</tr>
																</thead>
																<tbody>
															';

								$select = 'SELECT * from profiles';
								$result = mysql_query($select);
								while( $row = mysql_fetch_array( $result, MYSQL_ASSOC )){
									if( $row['user_id'] == $user_id ){
										$profiles_table .= '<tr>
																<td>' .
																	$row['name'] .
																'</td>

																<td>' .
																	$row['surname'] .
																'</td>

																<td>' .
																	$row['surname'] .
																'</td>

																<td>' .
																	$row['description'] .
																'</td>

																<td>
																	<img src="' . $avatar_url . '\\' . $row['user_id'] . '.jpg" alt="avatar" style="width:100px; height: 100px; display: block;">
																</td>
																<td>
																	<form>
																		<button type="submit" class="btn btn-success" name="edit_profile_data" value="' . $user_id . '">Edit</button>
																	</form>
																</td>
															</tr>';
									} else {
										$profiles_table .= '<tr>
																<td>' .
																	$row['name'] .
																'</td>

																<td>' .
																	$row['surname'] .
																'</td>

																<td>' .
																	$row['surname'] .
																'</td>

																<td>' .
																	$row['description'] .
																'</td>

																<td>
																	<img src="' . $avatar_url . '\\' . $row['user_id'] . '.jpg" alt="avatar" style="width:100px; height: 100px; display: block;">
																</td>
															</tr>';
									}
								}

								$profiles_table .= '</tr>
												</tbody>
											</table>
										</body>
										</html>';

								echo $profiles_table;

							} else {

								// Show form to create profile if profile is not exist.

								if( ! isset( $_POST['save_profile_data'] ) ){

									echo $view_profile_create->createProfileForm;

								} else {

									$controller_profile_data->saveAvatar( $user_id );
									if( $controller_profile_data->saveDataProfile ( $_POST['profile_name'],
																	$_POST['profile_surname'],
																	$_POST['profile_email'],
																	$_POST['profile_description'],
																	$user_id ) ){
									} else {
										echo $view_profile_create->createProfileForm;
									}
								}
							}
							unset($concurrences);
						}
					}
				} else {

					echo '<p class="login-error" style="margin: 10px 0; text-align: center; color: #f00;">* This name does not exist. Sing Up.</p>';
					echo $view_login->loginForm;
					unset($concurrences);

				}

			}

		}

	}

}

?>
