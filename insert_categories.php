<?php
include('connect.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Category</title>
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
    <p class="p">Insert Category</p>
    <div class="login">
        <div>
            <img src="images/admin_register.jpg" alt="">
        </div>
        <div class="content">
            <form action="" method="post">
                <div class="form">
                    <label class="user">Category</label>
                    <input type="text" class="input1" placeholder="Enter Category" required="required" name="category_title"/>
                </div>

                <div class="mt-4 pt-2">
                    <input type="submit" value="Insert" class="btn" name="insert">
                
                </div>
            </form>
        </div>
    </div> 
</body>
</html>

<?php
if (isset($_POST['insert'])) {
    $category_title = $_POST['category_title'];

    $select_query = "SELECT * FROM `category` WHERE category_title='$category_title'";
    $result = mysqli_query($con, $select_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Category already exists')</script>";
    } else {
        $insert_query = "INSERT INTO `category` (category_title) VALUES ('$category_title')";
        $sql_execute = mysqli_query($con, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }
    }
}
?>
