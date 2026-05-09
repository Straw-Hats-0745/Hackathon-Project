<?php
session_start();

$message = "";

$conn = mysqli_connect("localhost", "root", "", "test");

if(!$conn)
{
	die("Connection Failed");
}

function validateuser($name)
{
	if(empty($name))
	{
		return "Username cannot be empty.";
	}

	if(!preg_match("/^[a-zA-Z0-9_]{3,15}$/", $name))
	{
		return "Invalid username.";
	}

	return true;
}

function validatepassword($pwd)
{
	if(empty($pwd))
	{
		return "Password cannot be empty.";
	}

	if(strlen($pwd) < 6)
	{
		return "Password must be at least 6 characters long.";
	}

	if(!preg_match("/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/", $pwd))
	{
		return "Password must contain at least one capital letter and one number.";
	}

	return true;
}

function validateemail($email)
{
	if(empty($email))
	{
		return "Email cannot be empty.";
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		return "Invalid email format.";
	}

	return true;
}

if(isset($_POST['submit']))
{
	$name = trim($_POST['username']);
	$pwd = trim($_POST['password']);
	$email = trim($_POST['email']);

	// Username validation
	$check = validateuser($name);

	if($check !== true)
	{
		$message = $check;
	}
	else
	{
		// Check if username already exists
		$checkQuery = "SELECT * FROM logindata WHERE username='$name'";
		$checkResult = mysqli_query($conn, $checkQuery);

		if(mysqli_num_rows($checkResult) > 0)
		{
			$message = "User already exists.";
		}
		else
		{
			// Password validation
			$pwdCheck = validatepassword($pwd);

			if($pwdCheck !== true)
			{
				$message = $pwdCheck;
			}
			else
			{
				// Email validation
				$emailCheck = validateemail($email);

				if($emailCheck !== true)
				{
					$message = $emailCheck;
				}
				else
				{

					// Insert data
					$query = "INSERT INTO logindata(username,password,email)
					VALUES('$name','$pwd','$email')";

					$data = mysqli_query($conn, $query);

					if($data)
					{
						$_SESSION['username'] = $name;
						header("Location:display.php");
						exit();
					}
					else
					{
						$message = "Failed to insert data.";
					}
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>

	<link rel="stylesheet" type="text/css" href="signin-style.css">

	<style>
		.message{
			color:red;
			text-align:center;
			margin-top:10px;
			margin-bottom:10px;
			font-size:14px;
		}
	</style>
</head>

<body>

	<div class="container">

		<h1>Sign Up</h1>

		<?php
		if(!empty($message))
		{
			echo "<p class='message'>$message</p>";
		}
		?>

		<div class="form">

			<form method="POST">

				<br>
				<input type="email" name="email" placeholder="Write your email" class="input">

				<br>
				<input type="text" name="username" placeholder="Username" class="input">

				<br>
				<input type="password" name="password" placeholder="Password" class="input">

				<br>
				<input type="submit" name="submit" value="Sign Up" class="btn">

			</form>

		</div>

	</div>

</body>
</html>