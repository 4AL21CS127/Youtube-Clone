<?php
include('connect.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        img {
            width: 700px;
            margin-left: 210px;
        }
        .login {
            display: flex;
        }
        .content {
            margin-top: 120px;
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
        .input, .input1 {
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            padding-left: 10px;
        }
        .input {
            padding-right: 270px;
        }
        .input1 {
            padding-right: 270px;
        }
        .btn {
            color: black;
            border: none;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 20px;
            padding-left: 20px;
            background-color: lightblue;
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
    <p class="p">User Registration</p>
    <div class="login">
        <div>
            <img src="images/admin_register.jpg" alt="">
        </div>
        <div class="content">
            <form action="registration.php" method="post">
                <div class="form">
                    <label class="user">Username</label>
                    <input type="text" class="input1" placeholder="Enter your username" required="required" name="user_name"/>
                </div>
                <div class="form">
                    <label class="user">Email</label>
                    <input type="email" class="input" placeholder="Enter your email" required="required" name="user_email"/>
                </div>
                <div class="form">
                    <label class="user">Password</label>
                    <input type="password" class="input" placeholder="Enter your password" required="required" name="user_password"/>
                </div>
                <div class="form">
                    <label class="user">Confirm Password</label>
                    <input type="password" class="input" placeholder="Confirm password" required="required" name="confirm_password"/>
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="btn" name="user_register">
                    <p class="p1">Already have an account? <a href="login.php" class="p2"> Login</a> </p>
                </div>
            </form>
        </div>
    </div> 
</body>
</html>

<?php
if (isset($_POST['user_register'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_ip = getIPAddress();

    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_name' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username and email already exist')</script>";
    } elseif ($user_password != $confirm_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        $insert_query = "INSERT INTO `user_table` (user_name, user_email, user_password, user_ip) VALUES ('$user_name', '$user_email', '$user_password', '$user_ip')";
        $sql_execute = mysqli_query($con, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }
    }
}
?>
