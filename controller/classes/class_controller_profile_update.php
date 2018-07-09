<?php

/**
 * ControllerProfileUpdate class used to update profile data.
 *
 */

class ControllerProfileUpdate
{

	/**
	 * View profile update form.
	 *
	 * @param string $user_id   User ID.
	 *
	 */

	public function returnProfile( $user_id ){

		// View profile update form.

		$profileUpdateForm = '<!DOCTYPE html>
								<html lang="en">
								<head>
									<meta charset="UTF-8">
									<title>Create Prolife</title>
									<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
								</head>
								<body>
									<div class="wrapper" style="width: 80%; margin: 30px auto;">
										<form name="profile_create" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Name</label>';

		// View profile data.

		$select3 = "SELECT *
					FROM  `profiles`
					WHERE user_id =  '" . $user_id . "'";
		$result3 = mysql_query($select3);
		while( $row = mysql_fetch_array( $result3, MYSQL_ASSOC )){

			$profileUpdateForm .= '<input type="text" class="form-control" id="profile_name" name="profile_name" value="' . $row['name'] . '">
									</div>
									<div class="form-group">
										<label>Surname</label>';
			$profileUpdateForm .= '<input type="text" class="form-control" id="profile_surname" name="profile_surname" value="' . $row['surname'] . '">
									</div>
									<div class="form-group">
										<label>Email address</label>';
			$profileUpdateForm .= '<input type="text" class="form-control" id="profile_emaile" name="profile_email" value="' . $row['email'] . '">
									</div>
									<div class="form-group">
										<label>Description</label>';
			$profileUpdateForm .= '<textarea class="form-control" id="profile_description" name="profile_description" rows="3">' . $row['description'] . '</textarea>
									</div>
									<div class="form-group">
										<label>Avatar</label>
										<input type="file" class="form-control-file" id="profile_avatar" name="profile_avatar">
									</div>
									<button value="Save" id="btn6" class="btn btn-primary btn-lg" name="update_profile_data" style="float: right;">Save</button>
								</form>
							</div>
						</body>
						</html>';
		}

		return $profileUpdateForm;

	}

	/**
	 * Update profile data.
	 *
	 * @param string $profile_name          User name.
	 * @param string $profile_surname       User surname.
	 * @param string $profile_email         User email.
	 * @param string $profile_description   User description.
	 * @param string $user_id               User ID.
	 *
	 */

	public function updateDataProfile( $profile_name,
										$profile_surname,
										$profile_email,
										$profile_description,
										$user_id )
	{

		// Upload profile avatar.

		if ( $_FILES ) {
			if ( isset( $_POST['update_profile_data'] ) ) {
				if ( is_uploaded_file( $_FILES['profile_avatar']['tmp_name'] ) ) {
				$path = realpath('./img');
					move_uploaded_file( $_FILES['profile_avatar']['tmp_name'],
										$path . '\\' . $user_id . '.jpg' );
				}
			}
		}

		// Update profile data.

		$update = "UPDATE `profiles` SET name =  '" . $profile_name . "',
					surname = '" . $profile_surname . "',
					email = '" . $profile_email . "',
					description = '" . $profile_description . "'
				WHERE user_id = '" . $user_id . "'";

		mysql_query( $update );

		$error = mysql_errno();

		if( 0 == $error ){

			// Show profiles table.

			echo '<p class="message" style="margin: 10px 0; text-align: center;">Profile data has been saved</p>';

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
												<img src="' . $avatar_url . '\\' . $row['user_id'] . '.jpg" alt="avatar" style="width:100px; height: 100px;">
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

			unset($profileUpdateForm);

		} else{

			echo '<p class="message">Oops Something goes wrong</p>';
			return false;

		}

	}







































}


?>
