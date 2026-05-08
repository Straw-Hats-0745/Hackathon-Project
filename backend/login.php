<?php 
session_start();
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="login-style.css">
</head>
<body>
	<div class="center">
		<h1>Login<h1>
		<form method="post" action="#">
		<div class="form">
			<input type="text" name="username" class="textfield" placeholder="Username">
			<input type="password" name="password" class="textfield" placeholder="Password">

			<div class="forgotpass"><a href="#" class="link" onClick="alert('password yad karo');">Forgot Password</a></div>

			<input type="submit" name="login" value="Login" class="btn">

			<div class="signup">Don't have an account? <a href="http://localhost/fyc/signin/signin.php" class="link">Sign up here</a></div>		
		</div>
	</form>
</body>		
</html>

<?php 
 	$conn=mysqli_connect("localhost","root","","test");
 	if($conn)
 	{
 		//echo "connection ok";
 	}
 	else
 	{
 		echo "Login Failed";
 	}
 	if(isset($_POST['login']))
 	{
 		$username=$_POST['username'];
 		$pwd=$_POST['password'];
 		$query="select * from logindata where username='$username' && password='$pwd'";
 		$data=mysqli_query($conn,$query);
 		$total=mysqli_num_rows($data);
 		if($total==1)
 		{
		    $_SESSION['username'] = $username;
		    header('Location:practice.php');
 		}
 		else
 		{
 			echo "Login Failed";
 		}
 	}
 ?>