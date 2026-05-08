<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="signin-style.css">
</head>
<body>
	<div class="container">
		<h1>Sign In</h1>

		<div class="form">
			<form method="POST">
				
				<br><input type="email" name="email" placeholder="Write your email" class="input">

				<br><input type="text" name="username" placeholder="Username" class="input">

				<br><input type="password" name="password" placeholder="Password" class="input">

				<br><input type="submit" name="submit" value="Sign In" class="btn">

			</form>
		</div>
	</div>
</body>
</html>

<?php

$conn = mysqli_connect("localhost", "root", "", "test");

if($conn)
{
	// echo "Connection OK";
}
else
{
	die("Connection Failed");
}

function validateuser($name)
	{
		if(empty($name))
		{
			return "<br>Username cannot be empty.";
		}
		if(!preg_match("/^[a-zA-Z0-9_]{3,15}$/", $name))
		{
			return "<br>invalid username";
		}
		return true;
	}

if(isset($_POST['submit']))
{
    $name = $_POST['username'];
    $pwd = $_POST['password'];
    $email = $_POST['email'];

    // validate username
    $check = validateuser($name);

    if($check !== true)
    {
        echo $check;
        exit();
    }

    // check if user exists
    $checkQuery = "SELECT * FROM logindata WHERE username='$name'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if(mysqli_num_rows($checkResult) > 0)
    {
        echo "User already exists";
        exit();
    }

    // insert data
    $query = "INSERT INTO logindata(username,password,email)
              VALUES('$name','$pwd','$email')";

    $data = mysqli_query($conn, $query);

    if($data)
    {
        $_SESSION['username'] = $name;
        header("Location:http://localhost/fyc/login/practice.php");
        exit();
    }
    else
    {
        echo "Failed to insert data";
    }
}

?>