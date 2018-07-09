<?php

/**
 * ViewRegistrationForm class used to create an HTML list of registration form.
 *
 */

class ViewRegistrationForm
{

	/**
	 * HTML list of registration form.
	 *
	 * @var string
	 *
	 */

	public $registrationForm = '<!DOCTYPE html>
									<html lang="en">
									<head>
										<meta charset="UTF-8">
										<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
										<title>Registration</title>
										<style type="text/css">
											.registratio-error{
												margin: auto;
												color: #f00;
											}
										</style>
									</head>
									<body>
										<div class="panel well reg-form" style="width: 350px; padding: 25px; text-align: center; margin: auto;">
											<h2 style="margin-bottom: 35px">Registration</h2>
											<form name="registration">
												<div class="form-group">
													<label>Username</label>
													<input class="form-control input-lg" type="text" id="username_registration" name="username_registration"/>
												</div>
												<div class="form-group">
													<label>Password</label>
													<input class="form-control input-lg" type="text" id="password_registration" name="password_registration"/>
												</div>
												<div class="form-group">
													<input class="btn btn-lg btn-primary" type="submit" id="btn1" value="OK" name="registration_button"/>
													<button value="Log out" id="btn2" class="btn btn-success btn-lg" name="redirect_login_button">Log in</button>
												</div>
											</form>
										</div>
									</body>
									</html>';

}


?>
