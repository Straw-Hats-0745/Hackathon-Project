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
    if(isset($_POST['logout']))
    {
        session_destroy();
        header('location:login.php');
        exit();
    }
    if(isset($_POST['delete']))
    {
        $conn=mysqli_connect("localhost","root","","test");
        if($conn)
        {
            $username = $_SESSION['username'];
            $query = "DELETE FROM logindata WHERE username='$username'";
            $data = mysqli_query($conn, $query);
            if($data)
            {
                session_destroy();
                header('location:signin.php');
                exit();
            }
            else
            {
                echo "Failed to delete account.";
            }
        }
        else
        {
            echo "Database connection failed.";
        }
    }
    ?>
    <form action="display.php" method="post">
        <input type="submit" name="logout" value="logout" class="btn">
        <input type="submit" name="delete" value="delete account" class="btn">
    </form>

</body>
</html>