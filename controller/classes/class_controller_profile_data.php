<?php

/**
 * SaveProfileData class used to save profile data.
 *
 */

class SaveProfileData
{

	/**
	 * Save profile avatar.
	 *
	 * @param string $user_id   User ID.
	 *
	 */

	public function saveAvatar( $user_id )
	{
		if ( $_FILES ) {
			if ( isset( $_POST['redirect_registration_button'] ) ) {
				if ( is_uploaded_file( $_FILES['profile_avatar']['tmp_name'] ) ) {
				$path = realpath('./img');
					move_uploaded_file( $_FILES['profile_avatar']['tmp_name'],
										$path . '\\' . $user_id . '.jpg' );
				}
			}
		}
	}

	/**
	 * Save profile data.
	 *
	 * @param string $profile_name          User name.
	 * @param string $profile_surname       User surname.
	 * @param string $profile_email         User email.
	 * @param string $profile_description   User description.
	 * @param string $user_id               User ID.
	 *
	 */

	public function saveDataProfile( $profile_name,
									$profile_surname,
									$profile_email,
									$profile_description,
									$user_id )
	{

		if(isset($_POST['save_profile_data'])){

				// Validate profile data.

				if( "" == $profile_name ||
					"" == $profile_surname ||
					"" == $profile_email ||
					"" == $profile_description ){
					echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* Fill in all the fields.</p>';
					return false;
				}


				if ( 5 > strlen( $profile_name ) ||
					5 > strlen( $profile_surname ) ||
					5 > strlen( $profile_email ) ||
					5 > strlen( $profile_description ) ){
					echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* All fields must be at least 5 characters in length.</p>';
					return false;
				}

				$email_validation = preg_match( "(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})", $profile_email );
				if( $profile_email_validation && "" != $profile_email ){
					echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* Please enter correct email address.</p>';
					return false;
				}

				if(! $_FILES['profile_avatar']['tmp_name']){
						echo '<p class="registration-error" style="margin: 10px 0; text-align: center; color: #f00;">* Please upload avatar.</p>';
						return false;
				}

				// Save profile data.

				$insert2 = 'INSERT into profiles (name,
											 surname,
											 email,
											 description,
											 user_id)
							values("' . $profile_name . '",
									"' . $profile_surname . '",
									"' . $profile_email . '",
									"' . $profile_description . '",
									"' . $user_id . '")';

				mysql_query( $insert2 );

				$error = mysql_errno();

				if( 0 == $error ){

					// Show profiles table.

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
						} else{
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

					exit();

				} else{
					echo '<p class="registration-message">Oops Something goes wrong</p>';
					return false;
				}

		}

	}

}

?>
