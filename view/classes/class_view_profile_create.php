<?php

/**
 * ViewCreateProfile class used to create an HTML list of creating profile.
 *
 */

class ViewCreateProfile
{

	/**
	 * HTML list of form creating profile.
	 *
	 * @var string
	 *
	 */

	public $createProfileForm = '<!DOCTYPE html>
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
													<label>Name</label>
													<input type="text" class="form-control" id="profile_name" name="profile_name">
												</div>
												<div class="form-group">
													<label>Surname</label>
													<input type="text" class="form-control" id="profile_surname" name="profile_surname">
												</div>
												<div class="form-group">
													<label>Email address</label>
													<input type="text" class="form-control" id="profile_emaile" name="profile_email">
												</div>
												<div class="form-group">
													<label>Description</label>
													<textarea class="form-control" id="profile_description" name="profile_description" rows="3"></textarea>
												</div>
												<div class="form-group">
													<label>Avatar</label>
													<input type="file" class="form-control-file" id="profile_avatar" name="profile_avatar">
												</div>
												<button value="Save" id="btn6" class="btn btn-primary btn-lg" name="save_profile_data" style="float: right;">Save</button>
											</form>
										</div>
									</body>
									</html>';

}


?>
