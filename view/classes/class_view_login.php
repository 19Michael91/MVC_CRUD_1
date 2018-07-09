<?php

/**
 * ViewRegistrationForm class used to create an HTML list of login form.
 *
 */

class ViewLoginForm
{

	/**
	 * HTML list of login form.
	 *
	 * @var string
	 *
	 */

		public $loginForm = '<!DOCTYPE html>
								<html lang="en">
								<head>
									<meta charset="UTF-8">
									<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
									<title>Log in</title>
									<style type="text/css">
										.registratio-error{
											margin: auto;
											color: #f00;
										}
									</style>
								</head>
								<body>
									<div class="panel well log-form" style="width: 350px; padding: 25px; text-align: center; margin: auto;">
										<h2 style="margin-bottom: 35px">Log in</h2>
										<form name="login">
											<div class="form-group">
												<label>Username</label>
												<input class="form-control input-lg" type="text" id="username_login" name="username_login"/>
											</div>
											<div class="form-group">
												<label>Password</label>
												<input class="form-control input-lg" type="text" id="password_login" name="password_login"/>
											</div>
											<div class="form-group">
												<input class="btn btn-lg btn-primary" type="submit" id="btn3" value="OK" name="login_button"/>
												<button value="Log out" id="btn4" class="btn btn-success btn-lg" name="redirect_registration_button">Registration</button>
											</div>
										</form>
									</div>
								</body>
								</html>';

}


?>
