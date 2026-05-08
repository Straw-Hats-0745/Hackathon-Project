<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <style>
        .btn{
            padding: 10px 30px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <h1>Login Successful</h1>

    <?php 
    if(isset($_SESSION['username']))
    {
        echo "Welcome " . $_SESSION['username'];
    }
    else
    {
        header('location:login.php');
        exit();
    }
    ?>
    <form action="logout.php">
        <input type="submit" name="logout" value="logout" class="btn">
    </form>

</body>
</html>