<?php 
	if(!isset($_SESSION))
	{
		session_start();
	}


	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'stego');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		//echo $email;
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		//echo strlen($password_1);
		if(strlen($password_1) < 8 || strlen($password_1) >12)
		{
			array_push($errors, "Enter password from 8-12 character");
		}	
		$query = "SELECT username FROM users WHERE username='$username' OR email='$email'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 0) 
		{
			$password = $password_1;
		}
		else
		{
			array_push($errors, "username already exist");
		}
		//register user if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			//$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				//$_SESSION['success'] = "You are now logged in";
				header('location: ../home/index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	if(isset($_POST['forget']))
	{
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$query = "SELECT * FROM users WHERE email='$email'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1)
		{
			$result = mysqli_fetch_assoc($results);
			$result = "your password is " . $result['password'];
			if(mail($email,'password',$result,'From: we@gmail.com'))
			{
				array_push($errors, 'mail is sent to your email please check your email.');
			}
			else
			{
				array_push($errors, 'Error occur during mail sending');
			}
		}
		else
		{
			array_push($errors, 'Wrong email address');
		}
	}

?>