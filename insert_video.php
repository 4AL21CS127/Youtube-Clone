<?php
include('connect.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Video</title>
    <style>
        .form_select{
            padding-right:310px;
            padding-top:10px;
            padding-bottom:10px;
            border-radius:5px;
        }
        img {
            width: 700px;
            margin-left: 210px;
        }
        .login {
            display: flex;
            margin-top:0px;
        }
        .content {
            margin-top: 20px;
            margin-left: 520px;
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
            margin-bottom:0px;
            margin-top:0px;
            margin-top:20px;
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
        .input2{
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            padding-left: 10px;
            padding-right: 329px;
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
    <p class="p">Insert Video</p>
    <div class="login">
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <label class="user">Channel Name</label>
                    <input type="text" class="input1" placeholder="Enter name" required="required" name="Title"/>
                </div>
                <div class="form">
                    <label class="user">Heading</label>
                    <input type="text" class="input1" placeholder="Enter Heading" required="required" name="Heading"/>
                </div>
                <div class="form">
                    <label class="user">Keywords</label>
                    <input type="text" class="input1" placeholder="Enter Keywords" required="required" name="Keyword"/>
                </div>
                <div class="form">
                    <select name="video_category" id="" class="form_select">
                        <option value="">Select Category</option>
                        <?php
                        $select_query="Select * from `category`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['category_title']; //extracting the data from the database
                            $category_id=$row['category_id'];       //extracting the data from the database
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form">
                    <label class="user">Thumbnail</label>
                    <input type="file" class="input1" placeholder="Insert Thumbnail" required="required" name="Thumbnail"/>
                </div>
                <div class="form">
                    <label class="user">Video</label>
                    <input type="file" class="input1" placeholder="Insert Video" required="required" name="video"/>
                </div>
                <div class="form">
                    <label class="user">Date</label>
                    <input type="date" class="input2" placeholder="Enter Date" required="required" name="Date"/>
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
    $Title = $_POST['Title'];
    $Heading = $_POST['Heading'];
    $Date = $_POST['Date'];
    $Keyword = $_POST['Keyword'];
    $video_category = $_POST['video_category'];

    // Handle file uploads
    if (isset($_FILES['Thumbnail']) && isset($_FILES['video'])) {
        $Thumbnail = $_FILES['Thumbnail']['name'];
        $video = $_FILES['video']['name'];

        //accessing image temp names
        $temp_image = $_FILES['Thumbnail']['tmp_name'];
        $temp_image1 = $_FILES['video']['tmp_name'];

        if ($Title == '' || $Heading == '' || $Thumbnail == '' || $video == '' || $Date == '' || $Keyword == '') {
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        } else {
            move_uploaded_file($temp_image, "./images/$Thumbnail");
            move_uploaded_file($temp_image1, "./images/$video");

            //insert query
            $insert_products = "insert into `insert_video` (Title,Heading,Thumbnail,video,Date,keywords,category_id) values('$Title','$Heading','$Thumbnail','$video','$Date','$Keyword','$video_category')";
            $result_query = mysqli_query($con, $insert_products);
            if ($result_query) {
                echo "<script>alert('Successfully inserted the products')</script>";
            } else {
                echo "<script>alert('Failed to insert the products')</script>";
            }
        }
    } else {
        echo "<script>alert('Please upload both thumbnail and video files')</script>";
    }
}
?>
