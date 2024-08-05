<?php

include('connect.php');
include('functions.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        img {
            width: 700px;
            margin-left: 210px;
        }

        .login {
            display: flex;
        }

        .content {
            margin-top: 150px;
            margin-left: 80px;
        }

        .user {
            font-size: 17px;
            font-family: Arial, sans-serif;
            display: block;
            margin-bottom: 10px;
        }

        .p {
            text-align: center;
            font-size: 30px;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .form {
            margin-bottom: 30px;
        }

        .input {
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            padding-left: 10px;
            padding-right: 270px;
        }

        .btn {
            color: black;
            background-color: lightblue;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 20px;
            padding-left: 20px;
            border: none;
            font-size: 17px;
        }

        .p1 {
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .p2 {
            color: red;
        }
        
    </style>
</head>
<body>

    <p class="p">User Login</p>

    <div class="login">
        <div>
            <img src="images\admin_login.jpg" alt="">
        </div>

        <div class="content">
            <form action="" method="post">
                <div class="form">
                    <label class="user">Username</label>
                    <input type="text" class="input" placeholder="Enter your username" required="required" name="user_name"/>
                </div>

                <div class="form">
                    <label class="user">Password</label>
                    <input type="password" class="input" placeholder="Enter your password" required="required" name="user_password"/>
                </div>

                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="btn" name="user_login">
                    <p class="p1">Don't have an account ? <a href="registration.php" class="p2"> Register</a> </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php


if (isset($_POST['user_login'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_name'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    if ($row_count > 0) { 

        
        $_SESSION['user_name'] = $user_name;

        // Directly compare plain text password for now
        if ($user_password === $row_data['user_password']) {
            $_SESSION['user_name'] = $user_name;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}

?>
