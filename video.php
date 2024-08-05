<?php
include('connect.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Video</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="video.css" />
</head>
<body>
    <div class="headbar">
        <img src="images/menu.png" class="s1" />
        <img src="images/youtube.png" class="youtube" />
        <form action="search_video.php" method="get">
            <input type="text" placeholder="Search" class="search" name="searched" />
            <input type="submit" value="Search" class="search_submit" name="search_content"/>
        </form>
        <a href="insert_video.php">
            <img src="images/create.png" class="create" />
        </a>
        <a href="insert_categories.php">
            <img src="images/inser.png" class="create" />
        </a>
        <img src="images/notification.png" class="noti" />
        <img src="images/my_account.png" class="my_account" />
    </div>

    <div class="video_sub">
        <?php display(); ?>
    </div>
</body>
</html>
